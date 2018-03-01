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
        request()->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'year' => 'required|integer',
            'month' => 'required|integer',
            'number' => 'required|string',
            'holder' => 'required|string|max:255',
            'cvv' => 'required|integer',
        ]);

        try {
            $card = Card::where('number', $request->get('number'))
            ->where('cvc', $request->get('cvv'))
            ->whereYear('date_expired', '=', $request->get('year'))
            ->whereMonth('date_expired', '=', $request->get('month'))
            ->firstOrFail();
        } catch (ModelNotFoundException $ex) {
            return back()->withInput()->withErrors(['Transaction Fail Please Contact your card issuer ']);
        }
        try {
            DB::beginTransaction();

            $price = \Cart::getTotal();
            $card->check($price);

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->address2 = $request->address2;
            $customer->phone = $request->phone;
            $customer->mobile = $request->mobile;
            $customer->email = $request->email;
            $customer->save();


            $admin_card = Card::findOrFail(1);
             foreach (\Cart::getContent() as $item) {
            $myService = \App\Destination::find($item->id);
            $book = new Book();
            $book->date_book = $request->date;
            $book->service_id = $item->id;
            $book->customer_id = $customer->id;
            $book->business_id = $myService->user->business->id;
            $book->save();





            $card_transcation = new CardTranscation();
            $card_transcation->book_id = $book->id;
            $card_transcation->amount = $item->price;
            $card_transcation->type = 'BOOK';
            $card_transcation->card_id = $admin_card->id;

            $card_transcation->user_id = $myService->user_id;
            $card->balance = $card->balance - $item->price;
            $card->save();
            $admin_card->balance = $admin_card->balance + $item->price;
            $admin_card->save();
            $card_transcation->save();

             }

             \Cart::clear();
            DB::commit();

            return back()->withSuccess('Book successfully we email you if we confirm your reservation. Thank you');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withInput()->withErrors(['Transaction Fail Please Contact your card issuer dsadsadsa']);
        }
    }
}
