<?php

namespace App\Http\Controllers;

use App\Destination;
use App\PackageDetails;
use App\Packages;

class ServiceReviewController extends Controller
{
    public function create($id)
    {
        $service = Destination::findOrFail($id);

        return view('service_review', compact('service'));
    }

    public function store($id)
    {
        $detail = Destination::findOrFail($id);

        $detail->rating([
            'rating' => request('star'),
        ], $detail);

        return response()->json([], 201);
    }
}
