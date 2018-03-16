<?php

namespace App\Http\Controllers;

use App\Book;
use App\Card;
use App\CardTranscation;
use App\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutOrder extends Controller
{
    public function index()
    {
        return view('checkout_order');
    }

    public function store(Request $request)
    {
        $valid = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'additional' => 'required|integer',
        ];
        if ('card' == request('type')) {
            $valid['year'] = 'required|integer';
            $valid['month'] = 'required|integer';
            $valid['number'] = 'required|string';
            $valid['holder'] = 'required|string|max:255';
            $valid['cvv'] = 'required|integer';
        }
        request()->validate($valid);

        try {
            $bookable = 1;
            if ('card' == request('type')) {
                $card = Card::where('number', $request->get('number'))
            ->where('cvc', $request->get('cvv'))
            ->whereYear('date_expired', '=', $request->get('year'))
            ->whereMonth('date_expired', '=', $request->get('month'))
            ->firstOrFail();
            } else {
                $card = Card::find(1);
                $bookable = 0;
            }
        } catch (ModelNotFoundException $ex) {
            return back()->withInput()->withErrors(['Transaction Fail Please Contact your card issuer ']);
        }
        try {
            DB::beginTransaction();
            $additional_price = 0;
            if (request('additional') > 0) {
                foreach (\Cart::getContent() as $item) {
                    $additional_price = $additional_price + ($item->attributes['additional_rate'] * request('additional'));
                }
            }

            $price = \Cart::getTotal() + $additional_price;
            if (1 != $card->id) {
                $card->check($price);
            }

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->address2 = $request->address2;
            $customer->phone = $request->phone;
            $customer->mobile = $request->mobile;
            $customer->email = $request->email;
            $customer->save();

            $admin_card = Card::findOrFail(1);
            $first = true;
            $book_no = '0';
            foreach (\Cart::getContent() as $item) {
                $myService = \App\Destination::find($item->id);
                $book = new Book();
                $book->date_book = $request->date;
                $book->booked = $bookable;
                $book->service_id = $item->id;
                $book->customer_id = $customer->id;
                $book->business_id = $myService->user->business->id;
                $book->book_no = $book_no;
                $book->addtional_person = request('additional');

                $book->save();
                if ($first) {
                    $book->book_no = sprintf('%05d', $book->id);
                    $book->save();
                    $bookable = $book->booked;

                    $book_no = sprintf('%05d', $book->id);
                    $first = false;
                }

                $card_transcation = new CardTranscation();
                $card_transcation->book_id = $book->id;
                $card_transcation->amount = $item->price + (request('additional') * $item->attributes['additional_rate']);
                $card_transcation->type = 'BOOK';
                $card_transcation->card_id = $card->id;

                $card_transcation->user_id = $myService->user_id;
                $card->balance = $card->balance - $item->price;
                $card->save();
                $admin_card->balance = $admin_card->balance + $item->price;
                $admin_card->save();
                $card_transcation->save();
            }

            \Cart::clear();
            DB::commit();

            return back()->withSuccess('Book successfully we email you if we confirm your reservation. Thank you')->withBookable($bookable)
                ->withBookno($book_no)
                ->withPayment(request('type'));
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withInput()->withErrors(['Transaction Fail Please Contact your card issuer dsadsadsa']);
        }
    }
}
