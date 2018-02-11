<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store()
    {
        request()->validate([
        'email' => 'required|email',
        'name' => 'required|string',
        'message' => 'required',
        'subject' => 'required',
    ]);
        $client = new \stdClass();
        $client->email = request('email');
        $client->name = request('name');
        $client->message = request('message');
        $client->subject = request('subject');
        $admins = explode(',', env('ADMIN_EMAILS'));
        if (!env('APP_DEBUG')) {
            \Mail::to($admins)->send(new ContactUs($client));
        }

        return redirect()->back()->with('success', 'Thank you for emailing us we resolve this as soon as posible');
    }
}
