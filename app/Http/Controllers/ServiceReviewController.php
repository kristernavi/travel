<?php

namespace App\Http\Controllers;

use App\PackageDetails;
use App\Packages;

class ServiceReviewController extends Controller
{
    public function create($id)
    {
        $detail = PackageDetails::findOrFail($id);

        return view('service_review', compact('detail'));
    }

    public function store($id)
    {
        $detail = PackageDetails::findOrFail($id);

        $detail->rating([
            'rating' => request('star'),
        ], $detail);

        return response()->json([], 201);
    }
}
