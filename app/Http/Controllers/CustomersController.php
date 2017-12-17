<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $customers = \App\User::where('type', 'customers')->get();
        return view('admin.customers.admin_customers')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required', 
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|same:password_confirm',
            'type' => 'required', 
        ]);
        $status = \App\User::create($data); 
        return redirect('admin/customers')->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = \App\Destination::find($id);
        $destinations = \App\Destination::all();
        return view('admin.destinations.edit')->with('destination', $destination)->with('destinations', $destinations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'name' => 'required',  
            'description' => 'required',  
            'link' => 'nullable|url',   
            'image' => 'nullable|image|mimes:jpg,png,svg',
            'long' => 'nullable|string',   
            'lat' => 'nullable|string',
        ]);
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('public/destinations');
        } 
        $status = \App\Destination::find($id)->update($data); 
        return redirect('admin/destinations')->with('updated_status', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = \App\Destination::destroy($id);
        return redirect('admin/destinations')->with('is_deleted', $status);
    }
}
