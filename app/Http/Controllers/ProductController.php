<?php

namespace App\Http\Controllers;


use App\Models\Invoice_item;
use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product create with datatables

    public function productlistPage(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('products.*', 'categories.name as category_name')
                ->leftJoin('categories', 'products.category_id','categories.id')
                ->where('deleted_at','=',null)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $query =Invoice_item::where('product_id',$row->id)->first();
                    if($query){
                        $button = '<a href="' . route("productDetail", $row->id) . '" type="button" name="" id="' . $row->id . '" class="assignRole btn btn-outline-success  me-1"><i class="fa-solid fa-eye"></i></a>';
                        $button .= '<a href="' . route("productEdit", $row->id) . '" type="button" name="" id="' . $row->id . '" class="assignRole btn btn-outline-secondary me-1"> <i class="fa-regular fa-pen-to-square "></i></a>';
                        $button .= '<button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-outline-danger disabled"><i class="fa-solid fa-trash"></i></button>';
                        return $button;
                    }else{
                        $button = '<a href="' . route("productDetail", $row->id) . '" type="button" name="" id="' . $row->id . '" class="assignRole btn btn-outline-success me-1"><i class="fa-solid fa-eye"></i></a>';
                        $button .= '<a href="' . route("productEdit", $row->id) . '" type="button" name="" id="' . $row->id . '" class="assignRole btn btn-outline-secondary me-1"> <i class="fa-regular fa-pen-to-square "></i></a>';
                        $button .= '<button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>';
                        return $button;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.productlist');
    }

    public function createProductPage()
    {
        $categories = category::get();
        return view('admin.category.product', compact('categories'));
    }

    //product create
    public function createProduct(Request $request)
    {
        $this->validationCheck($request);
        if ($request->hasFile('image')) {
            $image = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $image);
            $data = ['image' => $image];
        }
        $data = [
            'barcode' => $request->barcode,
            'product_name' => $request->product_name,
            'category_id' => $request->category,
            'image' => $image,
            'sell_price' => $request->sell_price,
            'mfd' => $request->mfd,
            'exp' => $request->exp,
            'description' => $request->description,
        ];

        // dd($request->hasFile('image') ? 'yes' : 'no');
        Product::create($data);
        return redirect()->route('productlistPage');
    }

    private function validationCheck(Request $request)
    {
        Validator::make($request->all(), [
            'barcode' => 'required|unique:products,barcode',
            'product_name' => 'required|unique:products',
            'category' => 'required|not_in:0',
            'image' => 'required|mimes:jpg,bmp,png,jpeg,jfjf,webp|file|max:8192',
            'sell_price' => 'required',
            'mfd' => 'required',
            'exp' => 'required',
            'description' => 'required',
        ])->validate();
    }

    public function deleteProduct(Request $request)
    {   $product = Product::find($request->id);
        activity()->causedBy(auth()->user())
                  -> withProperties(['product_id'=>$product->id])
                  -> log('deleted a product');
        Product::where('id', $request->id)->delete();
        toast('deleted category successfully','success');
        return redirect()->route('productlistPage')->with('status', 'deleted category successfully');
    }
    //product edit
    public function productEdit($productId)
    {
        $product = Product::where('products.id', $productId)->select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->get();

        $categories = Category::get();
        return view('admin.category.productedit', compact('product', 'categories'));
    }

    //product update
    public function updateProduct(Request $request,Product $product)
    {
        $this->updateValidationCheck($request);
        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->categoryId,
            'sell_price' => $request->sell_price,
            'mfd' => $request->mfd,
            'exp' => $request->exp,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $dbData = Product::where('id', $request->id)->first();
            $dbImage = $dbData->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $image = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $image);
            $data['image'] = $image;
        }

        Product::where('id', $request->id)->update($data);



        $products = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->get();
        return view('admin.category.productlist', compact('products'));

        //    return redirect()->route('productlistPage')->with(['updateSuccess' =>'Product updated successfully.']);
    }
    private function updateValidationCheck(Request $request)
    {
        Validator::make($request->all(), [
            'product_name' => 'unique:products,product_name,' . $request->id,
        ])->validate();
    }

    //product detail
    public function productDetail($productId)
    {
        $product = Product::where('products.id', $productId)->select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->get();

        $categories = Category::get();
        return view('admin.category.detail', compact('product', 'categories'));
    }

    public function recentlyDeletedProduct(){
        $product_deleted = Product::get();
        dd($product_deleted);
        // return view('admin.category.productDeleted',compact('product_deleted'));
    }

    public function restoreProduct(Request $request){
        $product = Product::withTrashed()->where('barcode',$request->product_barcode)->restore();
        return response()->json(['message' =>'success']);
    }
}
