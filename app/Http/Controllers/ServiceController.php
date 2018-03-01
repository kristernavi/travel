<?php

namespace App\Http\Controllers;

use App\Destination;
use App\Municipality;
use App\PackageDetails;

class ServiceController extends Controller
{
    public function index()
    {
        $keyword = request('keyword') ? request('keyword') : '';
        $services = [];
        if (strlen($keyword) > 1) {
            $municipalities = Municipality::where('name', 'LIKE', "%$keyword%")->pluck('id');
            $services = Destination::whereIn('municipality_id', $municipalities)->get();

        } else {

            $services = Destination::take(12)->get();

        }

        return view('services', compact('services'));
    }
}
