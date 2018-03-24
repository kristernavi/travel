<?php

namespace App\Http\Controllers;

use App\Book;
use App\Card;
use App\CardTranscation;
use App\Customer;
use App\Packages;
use App\PaypalPayment\PaypalRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PayPal\Api\Item;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;

class BookController extends Controller
{
    public function create($id)
    {
        $package = Packages::findOrFail($id);

        return view('checkout', compact('package'));
    }

    public function paypal($request, $id)
    {
        $package = Packages::findOrFail($id);

        $price = $package->details->sum('price');
        $addprice = $package->additional_rate * request('additional');
        $price = $price + $addprice;

        $card = Card::find(1);
        $bookable = 0;

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->address2 = $request->address2;
        $customer->phone = $request->phone;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->save();
        $book = new Book();
        $book->date_book = $request->date;
        $book->package_id = $id;
        $book->addtional_person = request('additional');
        $book->customer_id = $customer->id;
        $book->business_id = $package->user->business->id;
        $book->booked = $bookable;
        $book->payment_type = request('type');
        $book->save();
        $book->book_no = sprintf('%05d', $book->id);
        $book->save();

        $admin_card = Card::findOrFail(1);

        $card_transcation = new CardTranscation();
        $card_transcation->book_id = $book->id;
        $card_transcation->amount = $price;
        $card_transcation->type = 'BOOK';
        $card_transcation->card_id = $card->id;
        $card_transcation->user_id = $package->user->id;
        $card->balance = $card->balance - $price;
        $card->save();
        $admin_card->balance = $admin_card->balance + $price;
        $admin_card->save();
        $card_transcation->save();

        $paypal = new PaypalRepository();
        $iteamble = [];
        $item1 = new Item();
        $item1->setName($package->name)
                ->setCurrency('PHP')
                ->setQuantity(1)
                ->setSku($id)
                ->setPrice($package->details->sum('price'));
        array_push($iteamble, $item1);
        if ($addprice > 0) {
            $addperson = new Item();
            $addperson->setName('Additional Persons')
                    ->setCurrency('PHP')
                    ->setQuantity(request('additional'))
                    ->setSku('1000012223')
                    ->setPrice($package->additional_rate);
            array_push($iteamble, $addperson);

            $bookable = 1;
        }

        return redirect($paypal->createPayment($iteamble, $price, url('success/new-book/'.$book->id), url('cancel/new-book/'.$book->id)));
    }

    public function store(Request $request, $id)
    {
        $valid = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ];
        if ('card' == request('type')) {
            $valid['year'] = 'required|integer';
            $valid['month'] = 'required|integer';
            $valid['number'] = 'required|string';
            $valid['holder'] = 'required|string|max:255';
            $valid['cvv'] = 'required|integer';
        }
        request()->validate($valid);
        if ('paypal' == request('type')) {
            return $this->paypal($request, $id);
        }

        try {
            $package = Packages::findOrFail($id);

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

            $price = $package->details->sum('price');
            $addprice = $package->additional_rate * request('additional');
            $price = $price + $addprice;

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
            $book = new Book();
            $book->date_book = $request->date;
            $book->package_id = $id;
            $book->addtional_person = request('additional');
            $book->customer_id = $customer->id;
            $book->business_id = $package->user->business->id;
            $book->booked = $bookable;
            $book->payment_type = request('type');
            $book->save();
            $book->book_no = sprintf('%05d', $book->id);
            $book->save();

            $admin_card = Card::findOrFail(1);

            $card_transcation = new CardTranscation();
            $card_transcation->book_id = $book->id;
            $card_transcation->amount = $price;
            $card_transcation->type = 'BOOK';
            $card_transcation->card_id = $card->id;
            $card_transcation->user_id = $package->user->id;
            $card->balance = $card->balance - $price;
            $card->save();
            $admin_card->balance = $admin_card->balance + $price;
            $admin_card->save();
            $card_transcation->save();
            DB::commit();

            return back()->withSuccess('Book successfully we email you if we confirm your reservation. Thank you')->withBook($book)
                ->withAmount($price)
                ->withPayment(request('type'));
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withInput()->withErrors(['Transaction Fail Please Contact your card issuer ']);
        }
    }

    public function excute(Request $request, $id)
    {
        $paypalContext = new PaypalRepository();
        $book = Book::findOrFail($id);
        $book->booked = 1;
        $book->paypal_id = $request->input('paymentId');
        $book->save();

        try {
            $paymentExecute = new PaymentExecution();
            $payment = Payment::get($request->input('paymentId'), $paypalContext->getApiContext());
            $execution = $paymentExecute->setPayerId($request->input('PayerID'));
            $trans = $payment->execute($execution, $paypalContext->getApiContext());
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getData();
        }

        return redirect('/new-book/'.$book->package->id)->withSuccess('Book successfully we email you if we confirm your reservation. Thank you')->withBook($book);
    }

    public function paypal_cancel($id)
    {
        $transaction = CardTranscation::where('book_id', $id)->delete();
        $book = Book::find($id);
        $package = $book->package;
        $book->delete();

        return redirect('/new-book/'.$package->id);
    }
}
