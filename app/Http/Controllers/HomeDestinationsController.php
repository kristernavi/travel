<?php

namespace App\Http\Controllers;

use App\Destination;
use App\Municipality;
use App\PackageDetails;
use App\Packages;

class HomeDestinationsController extends Controller
{
    public function index()
    {
        $keyword = request('keyword') ? request('keyword') : '';
        $details = [];
        if (strlen($keyword) > 1) {
            $municipalities = Municipality::where('name', 'LIKE', "%$keyword%")->pluck('id');
            $destinations = Destination::whereIn('municipality_id', $municipalities)->pluck('id');
            $details = PackageDetails::whereIn('destination_id', $destinations)->uniquePackage()->get();
        } else {
            $details = PackageDetails::inRandomOrder()->uniquePackage()->take(10)->get();
        }

        return view('price', compact('details'));
    }

    public function show($id)
    {
        $package = Packages::findOrFail($id);

        return view('destinations', compact('package'));
    }
}
