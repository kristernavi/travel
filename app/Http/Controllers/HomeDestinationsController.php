<?php

namespace App\Http\Controllers;

use App\Destination;

class HomeDestinationsController extends Controller
{
    public function index()
    {
        $destinations = Destination::paginate(10);

        return view('price', compact('destinations'));
    }

    public function show($id)
    {
        $destination = Destination::find($id);

        return view('destinations', compact('destination'));
    }
}
