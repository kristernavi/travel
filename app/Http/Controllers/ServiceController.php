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
        $details = [];
        if (strlen($keyword) > 1) {
            $municipalities = Municipality::where('name', 'LIKE', "%$keyword%")->pluck('id');
            $destinations = Destination::whereIn('municipality_id', $municipalities)->pluck('id');
            $details = PackageDetails::whereIn('destination_id', $destinations)->groupBy('destination_id')->get();
        } else {
            $details = PackageDetails::take(10)->groupBy('destination_id')->get();
        }

        return view('services', compact('details'));
    }
}
