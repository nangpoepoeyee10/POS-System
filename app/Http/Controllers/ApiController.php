<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock_in;
use App\Models\Inventory;
use App\Models\Invoice_item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function loginApi(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            $result = User::select('id', 'staff_id', 'name', 'email', 'image', 'role', 'gender')
                ->where('email', $request->email)->first();
            $token = $request->user()->createToken('login_token')->plainTextToken; //samctum
            // $token = $request->user()->createToken('login_token')->accessToken; //oAuth
            // $decodedImage = base64_encode(storage_path().$result->image);
            // $imagePath =  public_path('storage/'.$result->image);
            // $imageData = file_get_contents($imagePath);
            // $base64Image = base64_encode($imageData);

            $response = [
                'status' => 200,
                'token' => $token,
                'result' => $result,
                // 'decoded_image' => $base64Image
            ];
            return response()->json($response, 200); // return response()->json(["status" => 200, $token, $result], 200);

        } else {
            return response()->json(["status" => 401, "data" => "User name and Password is incorrect."], 200);
        }
    }
    public function userCreate(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            // 'image' => $this->post('image'),
            'role' => 'user',
        ];
        User::create($data);
        return response()->json(["status" => true], 200);
    }

    //getUserData
    public function getUserData()
    {

        $data = User::get();
        return response()->json(["status" => true, $data, 200]);
    }

    //updateUser
    public function updateUserApi(Request $request)
    {
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $request->userId)->first();
            $dbImage = $dbImage['image'];
            if ($dbImage != null) {
                Storage::delete('/public' . $dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
        }
        Validator::make($request->all(), [
            'name' => 'required|unique:users,name,' . $request->id,
            'image' => 'mimes:png,jpg,jfjf,jpeg',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $fileName,
        ];
        User::where('id', $request->userId)->update($data);
        return response()->json(["status" => true, 200]);
    }

    //deleteUserApi
    public function deleteUserApi(Request $request)
    {
        User::where('id', $request->userId)->delete();
        return response()->json(["status" => true, 200]);
    }
    //category create
    public function createCategoryApi(Request $request)
    {
        $data = [
            'name' => $request->name,
        ];
        Category::create($data);
        return response()->json(["status" => true], 200);
    }
    //category delete
    public function deleteCategoryApi(Request $request)
    {
        Category::where('id', $request->categoryId)->delete();
        return response()->json(["status" => true, 200]);
    }
    //retrieve category
    public function getCategoryData()
    {
        $data = Category::get();
        return response()->json(["status" => true, $data, 200]);
    }
    //create product
    public function createProductApi(Request $request)
    {
        $data = [
            'barcode' => $request->barcode,
            'productName' => $request->productName,
            'category_id' => $request->category,
            'quantity' => $request->quantity,
            'image' => $request->image,
            'buyPrice' => $request->buyPrice,
            'sellPrice' => $request->sellPrice,
            'mfd' => $request->mfd,
            'exp' => $request->exp,
            'description' => $request->description,
        ];
        Product::create($data);
        return response()->json(["status" => true], 200);
    }

    //productdeleteapi
    public function deleteProductApi(Request $request)
    {
        Product::where('id', $request->productId)->delete();
        return response()->json(["status" => true, 200]);
    }
    //retrieveproductapi
    public function getProductData()
    {
        $data = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->get();
        return response()->json(["status" => true, $data, 200]);
    }

    //stockcreateapi
    public function createStockApi(Request $request)
    {
        $data = [
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'purchase_price' => $request->purchasePrice,
            'date' => $request->date,
        ];
        Stock_in::create($data);
        return response()->json(["status" => true], 200);
    }

    //stockdeleteapi
    public function deleteStockApi(Request $request)
    {
        Stock_in::where('id', $request->stockId)->delete();
        return response()->json(["status" => true, 200]);
    }

    //retrievestockapi
    public function getStockData()
    {
        $data = Stock_in::select('stock_ins.*', 'products.product_name as product_name')
            ->leftJoin('products', 'products.id', 'stock_ins.product_id')
            ->get();
        return response()->json(["status" => true, $data, 200]);
    }

    // retrieve best selling product
    public function bestSeller()
    {
        $bestseller = Inventory::orderBy('stock_balance', 'asc')
            ->leftJoin('products', 'products.id', 'inventories.product_id')
            ->get()->take(10);
        return response()->json(["status" => true, $bestseller, 200]);
    }
    public function createOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $order = $request->order_item;
            $result = json_decode($order, true);
            $query = Invoice::select('invoice_id')->max('invoice_id');
            if ($query) {
                $e = explode('-', $query);
                $invoice_id = "INV-" . str_pad($e[1] + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $invoice_id = "INV-000001";
            }
            foreach ($result as $r) {
                $invoice = [
                    'invoice_id' => $invoice_id,
                    'user_id' => $request->user_id,
                    'customer_id' => $request->customer_id,
                    'payment_id' => $request->payment_id,
                    'total_amount' => $request->total_amount,
                    'discount' => $request->discount,
                    'sub_total' => $request->sub_total,
                    'payment_status' => $request->payment_status,
                ];

                $invoice_item = [
                    'invoice_id' => $invoice_id,
                    'product_id' => $r['product_id'],
                    'qty' => $r['qty'],
                    'unit_price' => $r['unit_price'],
                    'total' => $r['total'],
                ];
                Invoice_item::create($invoice_item);
                // $invoiceSelect = Invoice_item::select('invoice_id', $invoice_id)->where('qty', $r['qty'])->first();

                $productId = Invoice_item::where('invoice_id', $invoice_id)->first();
                $inventory = Inventory::select('stock_balance')->where('product_id', $productId->product_id)->first();

                if ($inventory) {
                    $inventory_stock_balance = $inventory->stock_balance - $productId->qty;
                    Inventory::where('product_id', $productId->product_id)->update(['stock_balance' => $inventory_stock_balance]);
                }
            }
            $invoice = Invoice::create($invoice);
            DB::commit();
            return response()->json(["status" => true], 200);

        } catch(Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false], 500);
        }
    }

    public function changePasswordApi(Request $request)
    {
        logger($request->toArray());
        Validator::make($request->all(), [
            'new_pwd' => 'min:8',
            'confirm_pwd' => 'min:8|same:new_pwd',
        ])->validate();
        $data = User::select('password')->where('id', $request->user_id)->first();
        logger($data->password);
        $dataHash = $data['password'];
        if (Hash::check($request->old_pwd, $dataHash)) {
            $requestHash = Hash::make($request->new_pwd);
            User::where('id', $request->user_id)->update(['password' => $requestHash]);
            return response()->json(["status" => true, 'message' => 'change password successful.'], 200);
        } else {
            return response()->json(["status" => false, 'message' => 'old password and new password does not match.'], 401);
        }
    }
    public function editProfileApi(Request $request)
    {
        logger($request);
        Validator::make($request->all(), [
            'email' => 'unique:users,email,' . $request->user_id,
        ], [])->validate();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,

        ];
        if (asset($request->image)) {
            // $imagePath =  public_path('storage/'.$request->image);
            // $imageData = file_get_contents($imagePath);
            // $base64Image = base64_decode($request->image);

            // $dbImage = User::where('id', $request->user_id)->first();
            // $dbImage = $dbImage->image;
            // if ($dbImage != null) {
            //     Storage::delete('public/' . $dbImage);
            // }
            // $image = uniqid() . $request->file('image')->getClientOriginalName();
            // $request->file('image')->storeAs('public', $image);
            $data['image'] = $request->image;
        }

        $response = User::where('id', $request->user_id)->update($data);
        if ($response) {
            $result = User::where('id', $request->user_id)->get()->toArray();

            return response()->json(["status" => true, 'result' => $result, 'message' => 'update profile successful.'], 200);
        } else {
            return response()->json(["status" => false, 'message' => 'unsuccess'], 401);
        }
    }

    //totalSale
    public function totalSaleQty()
    {
        $date = Carbon::now();
        $totalSale = Invoice::select(DB::raw('sum(total_amount) as total_sale'))
            ->whereDate('created_at', $date)->get();

        $totalQty = Invoice_item::select(DB::raw('sum(qty) as total_qty'))
            ->whereDate('created_at', $date)->get();

        return response()->json(["status" => 200, $totalSale, $totalQty], 200);
    }

    //retrieve invoice id and total amount
    public function invoiceId()
    {
        $invoices = Invoice::get();
        $receipt = Invoice_item::select('invoice_items.*', 'products.product_name as product_name')
            ->leftJoin('products', 'products.id', 'invoice_items.product_id')
            ->get();
        return response()->json(["status" => true, $invoices, $receipt, 200]);
    }

    public function logoutApi(Request $request)
    {   $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
