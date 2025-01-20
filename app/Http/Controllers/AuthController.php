<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Stock_in;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // dashboard
    // barchart
    public function dashboard()
    {
        $stock = Stock_in::select(
            DB::raw('sum(qty) as sumOfStock')
        )->get();
        $stockBalance = $stock[0]->sumOfStock;
        if ($stockBalance == null) {
            $stockBalance = 0;
        }

        $carbon_products = Invoice::select(
            DB::raw('sum(total_amount) as sums')
        )->whereDate('created_at', Carbon::now())->get();
        $carbon_products_daily = $carbon_products[0]->sums;

        if ($carbon_products_daily == null) {
            $carbon_products_daily = 0;
        }

        $day = Carbon::now();

        $month = explode('-', Carbon::now()->month);
        $carbon_products_monthly = Invoice::select(
            DB::raw('sum(total_amount) as sums')
        )->whereMonth('created_at', '=', $month)->get();
        $monthly_sale = $carbon_products_monthly[0]->sums;

        if ($monthly_sale == null) {
            $monthly_sale = 0;
        }

        $year = Carbon::now()->year;
        $db_year = Invoice::select(DB::raw('YEAR(created_at) as years'))->groupBy('years')->get();
        $product = Product::get();

        $products1 = Inventory::orderBy('stock_balance', 'desc')
            ->leftJoin('products', 'products.id', 'inventories.product_id')
            ->get()->take(5);
        $products2 = Inventory::orderBy('stock_balance', 'asc')
            ->leftJoin('products', 'products.id', 'inventories.product_id')
            ->get()->take(5);

        $this_month = explode('-', Carbon::now()->month);
        $last_month = Carbon::now()->subMonth();
        $last_month = $last_month->month;

        $today_income = Invoice::select(DB::raw('sum(total_amount) as sums'))->whereDate('created_at', Carbon::now())->get()->toArray();
        $yesterday_income = Invoice::select(DB::raw('sum(total_amount) as sums'))->whereDate('created_at', Carbon::yesterday())->get()->toArray();

        $this_month = Invoice::select(DB::raw('sum(total_amount) as sums'))->whereMonth('created_at', $this_month)->get()->toArray();
        $last_month = Invoice::select(DB::raw('sum(total_amount) as sums'))->whereMonth('created_at', $last_month)->get()->toArray();
        $compareIncome = $today_income[0]['sums'] < $yesterday_income[0]['sums'] ? 'less' : 'not less';
        $compareIncomeMonthly = $this_month[0]['sums'] < $last_month[0]['sums'] ? 'less' : 'not less';

        return view('admin.first', compact('stockBalance', 'day', 'products1', 'products2', 'carbon_products_daily', 'monthly_sale', 'year', 'db_year', 'compareIncome', 'compareIncomeMonthly', 'this_month'));
    }

    public function login()
    {
        return view('auth.login');
    }

    // forgotPasswordPage
    public function forgotPasswordPage()
    {
        return view('auth.forgot-password');
    }

    // forgotPassword
    public function forgotPassword(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ], [])->validate();

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('admin.user.email.forgotPasswordLink', ['token' => $token], function ($message) use ($request) {
            $message->from('pointofsale.mm@gmail.com');
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with(['message' => 'reset password has been send']);
    }

    // resetPasswordPage
    public function resetPasswordPage($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // resetPassword
    public function resetPassword(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ], [])->validate();
        $data = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();
        if (!$data) {
            return back()->withInput()->with(['message' => 'something went wrong.']);
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email' => $request->email])->delete();
        toast('Password has been changed', 'success');

        return redirect('/')->with('message', 'Password has been changed!');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect('/');
    }

    public function loginUser(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if (Auth::user()->role != 'staff') {
                return redirect()->route('dashboard');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
