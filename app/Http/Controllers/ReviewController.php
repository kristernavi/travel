<?php

namespace App\Http\Controllers;

use App\Packages;

class ReviewController extends Controller
{
    public function create($id)
    {
        $package = Packages::findOrFail($id);

        return view('review', compact('package'));
    }

    public function store($id)
    {
        $package = Packages::findOrFail($id);

        $package->rating([
            'rating' => request('star'),
        ], $package);

        return response()->json([], 201);
    }
}
