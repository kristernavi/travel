<?php

namespace App\Http\Controllers;

class AdminServiceOrder extends Controller
{
    public function all()
    {
        if ('admin' == \Auth::user()->type) {
            $data = \App\Book::whereNotNull('service_id')->get();
        } else {
            $ids = \Auth::user()->packages->pluck('id');

            $data = \App\Book::whereIn('service_id', $ids)->whereNotNull('service_id')->get();
        }

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
                return number_format($column->transactions()->where('type', 'BOOK')->sum('amount'), 2);
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
}
