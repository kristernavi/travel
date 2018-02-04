<?php

namespace App\Http\Controllers;

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
}
