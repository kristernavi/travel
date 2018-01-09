<?php

namespace App\Http\Controllers;

use App\Business;
use App\User;

class BusinessController extends Controller
{
    public function create()
    {
        return view('business.register')->with('message', 'Thank you for sign up We verify your account as soon as possible');
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'business' => 'required',
            'base' => 'required',
            'type' => 'required|in:hotel,tourist',
            'license' => 'nullable|min:3',
            'webiste' => 'nullable|regex:@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i',
            'address' => 'required',
            'mobile' => 'required|integer',
            'phone' => 'nullable',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->type = request('type');
        $user->address = request('address');
        $user->save();
        $business = new Business();
        $business->user_id = $user->id;
        $business->name = request('business');
        $business->base = request('base');
        $business->license = request('license');
        $business->website = request('website');
        $business->address = request('address');
        $business->mobile = request('mobile');
        $business->phone = request('phone');
        $business->save();

        return redirect()->back()->with('message', 'Thank you for sign up We verify your account as soon as possible');
    }
}
