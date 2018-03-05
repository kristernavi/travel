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
            $servicesHotel = Destination::whereIn('municipality_id', $municipalities)->where('type','hotel')->get();
            $servicesTourist =  Destination::whereIn('municipality_id', $municipalities)->where('type','tourist')->get();


        } else {

            $servicesHotel = Destination::where('type','hotel')->inRandomOrder()->take(8)->get();
            $servicesTourist =  Destination::where('type','tourist')->inRandomOrder()->take(8)->get();

        }
        return view('services', ['servicesHotel' => $servicesHotel, 'servicesTourist' => $servicesTourist]);
    }
}
