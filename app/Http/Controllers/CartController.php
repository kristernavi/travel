<?php

namespace App\Http\Controllers;

use App\Destination;
use App\PackageDetails;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store()
    {
        $id = request('service_id');
        $service = Destination::findOrFail($id);

        if (null == \Cart::get($id)) {
            \Cart::add([
            'id' => $service->id,
            'name' => $service->name,
            'price' => $service->price,
            'quantity' => 1,
            'attributes' => [],
        ]);
        }

        return response()->json([], 201);
    }

    public function destory($id)
    {
        \Cart::remove($id);

        return redirect()->back()->withInput();
    }
}
