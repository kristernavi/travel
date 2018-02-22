<?php

namespace App\Http\Controllers;

use App\Destination;
use App\Municipality;
use App\PackageDetails;
use App\Packages;
use Illuminate\Support\Facades\DB;

class HomeDestinationsController extends Controller
{
    public function index()
    {
        $keyword = request('keyword') ? request('keyword') : '';
        $owner = request('owner') ? request('owner') : '';
        if(strlen($owner) > 1)
        {
            $business = \App\Business::where('name', $owner)->pluck('user_id');
        }
        $details = [];
        if (strlen($keyword) > 1) {
            $municipalities = Municipality::where('name', 'LIKE', "%$keyword%")->pluck('id');
            $destinations = Destination::whereIn('municipality_id', $municipalities)->pluck('id');
            $details = PackageDetails::select(DB::raw('id,package_id,destination_id,user_id,SUM(price) as total_price'))->whereIn('destination_id', $destinations)
                ->uniquePackage();
        } else {
            $details = PackageDetails::select(DB::raw('id,package_id,destination_id,user_id,SUM(price) as total_price'))->inRandomOrder()->uniquePackage()->take(10);
        }
         if(strlen($owner) > 1)
        {
            $details = $details->whereIn('user_id',$business);
        }
         $details = $details->get();
        $details = $details->sortBy('total_price');

        return view('price', compact('details'));
    }

    public function show($id)
    {
        $package = Packages::findOrFail($id);

        return view('destinations', compact('package'));
    }
}
