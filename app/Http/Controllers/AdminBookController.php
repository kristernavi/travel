<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;

class AdminBookController extends Controller
{
    public function all()
    {
        $data = \App\Book::all();

        return DataTables::of($data)
            ->AddColumn('date', function ($column) {
                return $column->date_book;
            })
            ->AddColumn('name', function ($column) {
                return $column->customer->name;
            })
             ->AddColumn('email', function ($column) {
                 return $column->customer->email;
             })
            ->AddColumn('package', function ($column) {
                return $column->package->name;
            })
            ->AddColumn('status', function ($column) {
                if ($column->actioned) {
                    return $column->confirmed ? 'Confirmed' : 'Rejected';
                }

                return '';
            })
            ->AddColumn('amount', function ($column) {
                return number_format($column->transactions->sum('amount'), 2);
            })
            ->AddColumn('actions', function ($column) {
                if (!$column->actioned) {
                    return '<div class="btn-group table-dropdown">
                            <button class="btn-xs btn btn-success confirm-data-btn" data-id="'.$column->id.'">
                                <i class="fa fa-edit"></i> Confirm
                            </button>
                            <button class="btn-xs btn btn-danger reject-data-btn" data-id="'.$column->id.'">
                                <i class="fa fa-trash-o"></i> Reject
                            </button>
                        </div>';
                }
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function index()
    {
        return view('admin.transaction.index');
    }

    public function update($id)
    {
    }
}
