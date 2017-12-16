<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $destinations = \App\Destination::all();
        return view('admin.destinations.admin_destinations')->with('destinations', $destinations);
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
            'description' => 'required',  
            'link' => 'nullable|url',   
            'image' => 'nullable|image|mimes:jpg,png,svg',
            'long' => 'nullable|string',   
            'lat' => 'nullable|string',
        ]);
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('public/destinations');
        } 
        $status = \App\Destination::create($data); 
        return redirect('admin/destinations')->with('status', $status);
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
        //
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
        //
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
