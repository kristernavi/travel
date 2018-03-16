<?php

namespace App\Http\Controllers;

use App\Destination;
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
            'attributes' => [
                'persons' => $service->persons,
                'owner' => optional($service->user->business)->name,
                'additional_rate' => $service->additional_rate,
                ],
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
