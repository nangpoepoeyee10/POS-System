<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\Stock_in;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class StockInController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:Super admin|Admin');
    // }
    // public function stockindetail(Request $request)
    // {
    //     // dd($request->toArray());
    //     if ($request->ajax()) {
    //         $data = Stock_in::select('stock_ins.*', 'products.product_name as product_name')
    //             ->leftJoin('products', 'products.id', 'stock_ins.product_id')
    //             ->get();
    //             // ->map(function ($stock) {
    //             //     $stock->stock_status = ($stock->qty > 0) ? 'In Stock' : 'Out of Stock';
    //             //     return $stock;
    //             // });
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             // ->addColumn('action', function($row){
    //             //     $button = '<button type="button" name="edit" id="'.$row->id.'" categoryName="'.$row->name.'" class="edit btn btn-primary btn-sm me-1"> <i class="fa-regular fa-pen-to-square " style="color: white;"></i></button>';
    //             //     $button .= '   <button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';

    // //             //     return $button;
    // //             //     })
    // //                 // ->rawColumns(['action'])
    //             ->make(true);
    //     }
    //     return view('admin.stock.detail');
    // }
    public function createStockPage()
    {
        $products =  product::get();
        return view('admin.stock.stockIn', compact('products'));
    }

    //stock create
    public function createStock(Request $request)
    {
        $data = [
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'purchase_price' => $request->purchasePrice,
            'date' => $request->date,

        ];
        $validationRules = [
            'product_id' => 'required|not_in:0',
            'qty' => 'required',
            'purchasePrice' => 'required',
            'date' => 'required',
        ];
        Validator::make($request->all(), $validationRules)->validate();
        $stock_in = Stock_in::create($data);
        $inventory = Inventory::where('product_id', $stock_in->product_id)->first();
        if ($inventory) {
            $inventory->stock_balance = $inventory->stock_balance + $stock_in->qty;
            $inventory->save();
        } else {
            $inventory = new Inventory;
            $inventory->product_id = $stock_in->product_id;
            $inventory->stock_balance = $stock_in->qty;
            $inventory->save();
        }
        return redirect()->route('inventory');
    }


    // stock list
    //   public function stocklistPage(){
    //     // $stocks=Stock_in::with('product')->get();
    //     $stocks= Stock_in::select('stock_ins.*','products.id as product_id','products.product_name as product_name')
    //     ->leftJoin('products','products.id','stock_ins.product_id')
    //     ->get();
    //         // $stocks = Stock_In::get();
    //      return view('admin.stock.stocklist',compact('stocks'));

    //    }

}
