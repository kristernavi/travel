<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class DestinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.destinations.admin_destinations');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'long' => 'nullable|string',
            'lat' => 'nullable|string',
            'municipality_id' => 'required',
        ]);
        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public/destinations');
        }
        $destination = new \App\Destination();
        $destination->name = $request->get('name');
        $destination->description = $request->get('description');
        $destination->link = $request->get('link');
        $destination->image = $image;
        $destination->municipality_id = $request->get('municipality_id');
        $destination->user_id = \Auth::id();
        $destination->long = $request->get('long');
        $destination->lat = $request->get('lat');
        if ($destination->save()) {
            return response()->json(['success' => true, 'msg' => 'Data Successfully added!']);
        } else {
            return response()->json(['success' => false, 'msg' => 'An error occured while adding data!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = \App\Destination::find($id);

        return view('admin.destinations.edit')->with('destination', $destination);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
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

        $destination = \App\Destination::find($id);
        $image = $destination->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public/destinations');
        }
        $destination->name = $request->get('name');
        $destination->description = $request->get('description');
        $destination->link = $request->get('link');
        $destination->image = $image;
        $destination->user_id = \Auth::id();
        $destination->long = $request->get('long');
        $destination->lat = $request->get('lat');
        if ($destination->save()) {
            return response()->json(['success' => true, 'msg' => 'Data Successfully updated!']);
        } else {
            return response()->json(['success' => false, 'msg' => 'An error occured while updating data!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = \App\Destination::destroy($id);
        if ($status) {
            return response()->json(['success' => true, 'msg' => 'Data Successfully deleted!']);
        } else {
            return response()->json(['success' => false, 'msg' => 'An error occured while deleting data!']);
        }
    }

    public function all()
    {
        DB::statement(DB::raw('set @row:=0'));
        if ('admin' == Auth::user()->type) {
            $data = \App\Destination::selectRaw('*, @row:=@row+1 as row');
        } else {
            $data = \App\Destination::selectRaw('*, @row:=@row+1 as row')->where('user_id', Auth::id());
        }

        return DataTables::of($data)
            ->AddColumn('row', function ($column) {
                return $column->row;
            })
            ->AddColumn('name', function ($column) {
                return $column->name;
            })
            ->AddColumn('description', function ($column) {
                return $column->description;
            })
            ->AddColumn('image', function ($column) {
                if ($column->image) {
                    return "<img alt='img' heigth='50' width='50' src='".asset('storage/'.ltrim($column->image, 'public'))."'>";
                } else {
                    return '';
                }
            })
            ->AddColumn('actions', function ($column) {
                return '<div class="btn-group table-dropdown">
                            <button class="btn-xs btn btn-primary edit-data-btn" data-id="'.$column->id.'">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="btn-xs btn btn-danger delete-data-btn" data-id="'.$column->id.'">
                                <i class="fa fa-trash-o"></i> Delete
                            </button>
                        </div>';
            })
            ->rawColumns(['actions', 'image'])
            ->make(true);
    }
}
