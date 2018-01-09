<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customers.admin_customers');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|same:password_confirm',
            'type' => 'required',
        ]);
        $data['password'] = bcrypt($data['password']);

        $status = \App\User::create($data);
        if ($status) {
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
        $user = \App\User::find($id);

        return view('admin.customers.edit')->with('user', $user);
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
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6|same:password_confirm',
            'type' => 'required',
        ]);

        $user = \App\User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        $user->type = 'customers';

        if ($user->save()) {
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
        $status = \App\User::destroy($id);
        if ($status) {
            return response()->json(['success' => true, 'msg' => 'Data Successfully deleted!']);
        } else {
            return response()->json(['success' => false, 'msg' => 'An error occured while deleting data!']);
        }
    }

    public function all()
    {
        DB::statement(DB::raw('set @row:=0'));
        $data = \App\User::selectRaw('*, users.id as u_id , @row:=@row+1 as row')->where('users.type', 'customers');

        return DataTables::of($data)
            ->AddColumn('row', function ($column) {
                return $column->row;
            })
            ->AddColumn('name', function ($column) {
                return $column->name;
            })
            ->AddColumn('actions', function ($column) {
                return '<div class="btn-group table-dropdown">
                            <button class="btn-xs btn btn-primary edit-data-btn" data-id="'.$column->u_id.'">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="btn-xs btn btn-danger delete-data-btn" data-id="'.$column->u_id.'">
                                <i class="fa fa-trash-o"></i> Delete
                            </button>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
