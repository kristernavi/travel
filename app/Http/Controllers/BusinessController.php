<?php

namespace App\Http\Controllers;

use App\Business;
use App\Mail\UserActive;
use App\User;
use DB;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function activate($id)
    {
        $user = \App\User::find($id);
        $user->actived = !$user->actived;
        $user->save();

        if (!env('APP_DEBUG')) {
            \Mail::to($user->email)->send(new UserActive($user));
        }

        return response()->json(['success' => true, 'msg' => 'Data Successfully updated!']);
    }

    public function all()
    {
        DB::statement(DB::raw('set @row:=0'));
        $data = \App\User::selectRaw('*, users.id as u_id , @row:=@row+1 as row')->where('users.type', '!=', 'admin');

        return DataTables::of($data)
            ->AddColumn('row', function ($column) {
                return $column->row;
            })
            ->AddColumn('name', function ($column) {
                return $column->name;
            })
            ->AddColumn('name', function ($column) {
                return $column->name;
            })
            ->AddColumn('business', function ($column) {
                return optional($column->business)->name;
            })
              ->AddColumn('document', function ($column) {
                  if (null != $column->business) {
                      if (null != $column->business->document) {
                          return    '<a  href="'.url('admin/download/'.$column->business->id).'" class="btn-xs btn btn-success" role="button" >
                                <i class="fa fa-download"></i> Download
                            </a>';
                      }
                  }
              })
            ->AddColumn('email', function ($column) {
                return $column->email;
            })
            ->AddColumn('status', function ($column) {
                return $column->actived ? 'Active' : 'Inactive';
            })

            ->AddColumn('actions', function ($column) {
                $label = 'Active';
                if ($column->actived) {
                    $label = 'Inactive';
                }

                return '<div class="btn-group table-dropdown">
                            <button class="btn-xs btn btn-success active-data-btn" data-id="'.$column->u_id.'">
                                <i class="fa fa-edit"></i>'.$label.'
                            </button>


                            <button class="btn-xs btn btn-danger delete-data-btn" data-id="'.$column->u_id.'">
                                <i class="fa fa-trash-o"></i> Delete
                            </button>
                        </div>';
            })
            ->rawColumns(['actions', 'document'])
            ->make(true);
    }

    public function index()
    {
        return view('admin.business');
    }

    public function create()
    {
        return view('business.register')->with('message', 'Thank you for sign up We verify your account as soon as possible');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'business' => 'required',
            'base' => 'required',
            'license' => 'nullable|min:3|unique:businesses,license',
            'document' => 'required|image|mimes:jpg,jpeg,png,svg',
            'webiste' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'address' => 'required',
            'mobile' => 'required|numeric',
            'phone' => 'nullable',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $image = $request->file('document')->store('public/documents');
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->type = 'hotel';
        $user->address = request('address');
        $user->save();
        $business = new Business();
        $business->user_id = $user->id;
        $business->name = request('business');
        $business->base = request('base');
        $business->document = $image;
        $business->license = request('license');
        $business->website = request('website');
        $business->address = request('address');
        $business->mobile = request('mobile');
        $business->phone = request('phone');
        $business->save();

        return back()->withSuccess('Thank you for sign up We verify your account as soon as possible');
    }

    public function download($id)
    {
        $business = Business::findOrFail($id);

        $storagePath = Storage::getDriver()->getAdapter()->getPathPrefix();
        $pathToFile = $storagePath.$business->document;
        $headers = [
              'Content-Type: application/jpg',
            ];

        return response()->download($pathToFile, "Business of {$business->name}.jpg", $headers);
    }
}
