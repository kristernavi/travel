<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.packages.admin_packages');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = \App\Destination::all();

        return view('admin.packages.create')->with('destinations', $destinations);
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
        try {
            DB::beginTransaction();

            $package = new \App\Packages();
            $package->name = $request->get('name');
            $package->description = $request->get('description');
            $package->user_id = \Auth::id();
            $package->min = $request->get('min');
            $package->save();

            for ($i = 0; $i < sizeof($request->get('destination_id')); ++$i) {
                $destination = new \App\PackageDetails();
                $destination->package_id = $package->id;
                $destination->destination_id = $request->get('destination_id')[$i];
                $destination->price = $request->get('price')[$i];
                $destination->save();
            }

            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Data successfully added!']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['success' => false, 'msg' => 'An error occured while trying to add a new record!']);
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
        $destinations = \App\Destination::all();
        $package = \App\Packages::find($id);

        return view('admin.packages.edit')->with('package', $package)->with('destinations', $destinations);
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
        try {
            DB::beginTransaction();

            $package = \App\Packages::find($id);
            $package->name = $request->get('name');
            $package->description = $request->get('description');
            $package->min = $request->get('min');
            $package->save();
            $d = \App\PackageDetails::where('package_id', $id)->delete();
            for ($i = 0; $i < sizeof($request->get('destination_id')); ++$i) {
                $destination = new \App\PackageDetails();
                $destination->package_id = $package->id;
                $destination->destination_id = $request->get('destination_id')[$i];
                $destination->price = $request->get('price')[$i];
                $destination->save();
            }

            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Data successfully updated!']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['success' => false, 'msg' => 'An error occured while trying to update a new record!']);
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
        try {
            DB::beginTransaction();

            $d = \App\PackageDetails::where('package_id', $id)->delete();
            $package = \App\Packages::destroy($id);

            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Data successfully deleted!']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['success' => false, 'msg' => 'An error occured while trying to delete a new record!']);
        }
    }

    public function all()
    {
        DB::statement(DB::raw('set @row:=0'));
        if ('admin' == \Auth::user()->type) {
            $data = \App\Packages::selectRaw('*, @row:=@row+1 as row');
        } else {
            $data = \App\Packages::selectRaw('*, @row:=@row+1 as row')->where('user_id', \Auth::id());
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
