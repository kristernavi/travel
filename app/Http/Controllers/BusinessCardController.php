<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BusinessCardController extends Controller
{
    public function index()
    {
        $business = \Auth::user()->business;
        $card = '';
        $balance = 0;
        if (null != $business->card) {
            $card = $business->card->number;
            $balance = $business->card->balance;
        }

        return view('admin.business_card')->with('card', $card)->with('balance', $balance);
    }
    public function store()
    {

        try {


         $business = \Auth::user()->business;
          $card_ids = \App\Business::where('card_id','!=', $business->card_id)
            ->where('card_id', '!=', 1)
            ->pluck('card_id');
            $card = \App\Card::where('number', request('number'))->whereNotIn('number',$card_ids)->firstOrFail();
        $business->card_id = $card->id;
        $business->save();
        }
        catch (ModelNotFoundException $ex) {
            return back()->withInput()->withErrors(['Oppss Something when wrong please check your card or contact the administrator ']);
        }
        catch (\Exception $ex) {
            return back()->withInput()->withErrors(['Oppss Something when wrong please check your card or contact the administrator ']);
        }

        return back()->withSuccess('Card Succefully Update');
    }
}
