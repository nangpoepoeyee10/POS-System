<?php

namespace App\Http\Controllers;

use App\Models\alert;
use App\Models\Inventory;
use App\Models\Stock_in;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{

    public function Inventory(Request $request)
    {
        $alertQty = alert::first();
        $alertQty = $alertQty->qty;

        if ($request->ajax()) {
            $data = Inventory::select('stock_balance', 'products.product_name as product_name')
                ->leftJoin('products', 'products.id', 'inventories.product_id')
                // ->join('stock_ins','products.id','stock_ins.product_id')
                ->get()
                ->map(function ($stock) {
                    $stock->stock_status = ($stock->stock_balance > 0) ? 'In Stock' : 'Out of Stock';
                    return $stock;
                });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<i class="fa-solid fa-exclamation fs-4 text-danger ms-4"></i>';
                    $query = alert::first();

                    $query1 = $query->qty;

                    if ($row->stock_balance < $query1) {
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
            // }
        }

        // For non-AJAX requests, return the view normally
        return view('admin.stock.stocklist');
    }
    public function stockindetail(Request $request)
    {
        if ($request->ajax()) {
            $data = Stock_in::select('stock_ins.*', 'products.product_name as product_name')
                ->leftJoin('products', 'products.id', 'stock_ins.product_id')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.stock.detail');
    }
}
