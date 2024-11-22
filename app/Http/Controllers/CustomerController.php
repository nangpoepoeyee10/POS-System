<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
     public function customercreate()
    {

        return view('admin.customer.create');
    }
    public function customerlistPage(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::select('customers.*')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.customer.list');
    }
}
