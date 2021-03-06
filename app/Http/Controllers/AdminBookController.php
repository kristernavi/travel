<?php

namespace App\Http\Controllers;

use App\CardTranscation;
use App\Mail\ReservationConfirm;
use App\Mail\ReservationReject;
use App\PaypalPayment\PaypalRepository;
use PayPal\Api\Amount;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;
use Yajra\DataTables\DataTables;
use PayPal\Api\Payment;

class AdminBookController extends Controller
{
    public function all()
    {
        if ('admin' == \Auth::user()->type) {
            $data = \App\Book::get();
        } else {
            $id = \Auth::user()->business->id;
            $data = \App\Book::where('business_id', $id)->where('booked', 1)->get();
        }

        return DataTables::of($data)
            ->AddColumn('date', function ($column) {
                return $column->date_book;
            })
            ->AddColumn('name', function ($column) {
                return $column->customer->name;
            })
             ->AddColumn('email', function ($column) {
                 return $column->customer->email;
             })
             ->AddColumn('book_no', function ($column) {
                 return  $column->book_no;
             })
            ->AddColumn('package', function ($column) {
                if (null != $column->package) {
                    return $column->package->name;
                } else {
                    return '';
                }
            })
            ->AddColumn('status', function ($column) {
                if ($column->actioned) {
                    return $column->confirmed ? 'Confirmed' : 'Rejected';
                }

                return '';
            })
            ->AddColumn('amount', function ($column) {
                return number_format($column->transactions()->where('type', 'BOOK')->sum('amount'), 2);
            })
            ->AddColumn('booked', function ($column) {
                $label = 'Confirm';
                $btnClass = 'success';
                if ($column->booked) {
                    $label = 'Revoke';
                    $btnClass = 'danger';
                }
                if (!$column->actioned) {
                    return '<div class="btn-group table-dropdown">
                            <button class="btn-xs btn btn-'.$btnClass.' update-data-btn" data-id="'.$column->id.'">
                                <i class="fa fa-edit"></i> '.$label.'
                            </button>
                            ';
                }
            })
            ->AddColumn('actions', function ($column) {
                if (!$column->actioned) {
                    return '<div class="btn-group table-dropdown">
                            <button class="btn-xs btn btn-success confirm-data-btn" data-id="'.$column->id.'">
                                <i class="fa fa-edit"></i> Confirm
                            </button>
                            <button class="btn-xs btn btn-danger reject-data-btn" data-id="'.$column->id.'">
                                <i class="fa fa-trash-o"></i> Reject
                            </button>
                        </div>';
                }
            })
            ->rawColumns(['actions', 'booked'])
            ->make(true);
    }

    public function index()
    {
        return view('admin.transaction.index');
    }

    public function confirm($id)
    {
        $book = \App\Book::findOrFail($id);
        if ($book->date_book < date('Y-m-d')) {
            return response()->json(['success' => false, 'msg' => 'Reservation cannot be confirm due for some reason do the reject action']);
        }
        $book->confirmed = true;
        $book->actioned = true;
        $book->save();

        $amount = $book->transactions()->where('type', 'BOOK')->sum('amount');
        $admin_card = \App\Card::find(1);
        $admin_balance = $admin_card->balance - $amount;
        $for_admin = $amount * .05;
        $for_business = $amount * .95;
        $admin_card->balance = $admin_balance + $for_admin;
        $admin_card->save();

        $business_card = $book->business->card;
        $business_card->balance = $business_card->balance + $for_business;
        $business_card->save();

        $card_transaction_admin = new CardTranscation();
        $card_transaction_admin->card_id = 1;
        $card_transaction_admin->book_id = $book->id;
        $card_transaction_admin->amount = $for_admin;
        $card_transaction_admin->type = 'TRANSFER';
        $card_transaction_admin->user_id = $book->business->user_id;
        $card_transaction_admin->save();

        $card_business = new CardTranscation();
        $card_business->card_id = 1;
        $card_business->book_id = $book->id;
        $card_business->amount = $for_business;
        $card_business->type = 'TRANSFER';
        $card_business->user_id = $book->business->user_id;
        $card_business->save();
        if (!env('APP_DEBUG')) {
            \Mail::to($book->customer->email)->send(new ReservationConfirm($book));
        }

        return response()->json(['success' => true, 'msg' => 'Reservation Confirm']);
    }

    public function reject($id)
    {
        $book = \App\Book::findOrFail($id);

        $book->confirmed = false;
        $book->actioned = true;
        $book->save();
        $paypalContext = new PaypalRepository();

        $amount = $book->transactions()->where('type', 'BOOK')->sum('amount');
        if ('paypal' == $book->payment_type) {
            $paypalContext = new PaypalRepository();
            $payments = Payment::get($book->paypal_id, $paypalContext->getApiContext());
            $obj = $payments->toJSON();
            $paypal_obj = json_decode($obj);
            $transaction_id = $paypal_obj->transactions[0]->related_resources[0]->sale->id;

            $amt = new Amount();
            $amt->setCurrency('PHP')
            ->setTotal($amount);
            $refundRequest = new RefundRequest();
            $refundRequest->setAmount($amt);
            $sale = new Sale();
            $sale->setId($transaction_id);
            $refundedSale = $sale->refundSale($refundRequest, $paypalContext->getApiContext());
        }
        $admin_card = \App\Card::find(1);
        $admin_balance = $admin_card->balance - $amount;
        $admin_card->balance = $admin_balance;
        $admin_card->save();

        $card_business = new CardTranscation();
        $card_business->card_id = 1;
        $card_business->book_id = $book->id;
        $card_business->amount = -$amount;
        $card_business->type = 'REFUND';
        $card_business->user_id = $book->business->user_id;
        $card_business->save();

        $transactions = $book->transactions()->where('type', 'BOOK')->get();

        foreach ($transactions as $transaction) {
            // code...
            $card_business = new CardTranscation();
            $card_business->card_id = $transaction->card_id;
            $card_business->book_id = $book->id;
            $card_business->amount = $transaction->amount;
            $card_business->type = 'REFUND';
            $card_business->user_id = $book->business->user_id;
            $card_business->save();

            $card = \App\Card::findOrFail($transaction->card_id);
            $card->balance = $card->balance + $transaction->amount;
            $card->save();
        }
        if (!env('APP_DEBUG')) {
            \Mail::to($book->customer->email)->send(new ReservationReject($book));
        }

        return response()->json(['success' => true, 'msg' => 'Reservation Rejected']);
    }

    public function updateBook($id)
    {
        $book = \App\Book::findOrFail($id);
        $book->booked = !$book->booked;
        $book->save();

        return response()->json(['success' => true, 'msg' => 'Book Updated']);
    }
}
