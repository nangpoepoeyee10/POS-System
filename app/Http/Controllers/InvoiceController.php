<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Inventory;
use App\Models\Invoice_item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function invoice(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('invoices')
                ->select(
                    'invoices.invoice_id',
                    'invoices.total_amount',
                    'invoices.discount',
                    'invoices.sub_total',
                    'invoices.payment_status'
                )
                // ->join('invoice_items', 'invoice_items.invoice_id', 'invoices.invoice_id')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function($row){
                //     $button = '<button type="button" name="edit" id="'.$row->id.'" categoryName="'.$row->name.'" class="edit btn btn-primary btn-sm me-1"> <i class="fa-regular fa-pen-to-square " style="color: white;"></i></button>';
                //     $button .= '   <button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';

                //     return $button;
                //     })
                // ->rawColumns(['action'])
                // ->orderBy('id', 'desc')
                ->make(true);
        }

        // return view('admin.first',compact('inventories'));
        return route('dashboard');
    }
    //invoice page
    public function invoicePage(Request $request)
    {
        if ($request->ajax()) {
            $invoices = Invoice::select('invoice_id', 'total_amount', 'discount', 'sub_total', 'payment_status')->get();
            return Datatables::of($invoices)->addIndexColumn()->make(true);
        }
        return view('admin.invoice.invoiceList');
    }
    //order items
    public function orderItems(Request $request)
    {

        $data = $request->order_item;
        $result = json_decode($data, true);


        foreach ($result as $r) {
            $product_id = $r['product_id'];
            dd($product_id);
        }
    }
}
