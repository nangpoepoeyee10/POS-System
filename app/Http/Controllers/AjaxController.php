<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Stock_in;
use App\Models\Invoice_item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //dailySale
    public function dailySale(Request $request){
        $result = Invoice::select(
            DB::raw('sum(total_amount) as sums')
        )->whereDate('created_at',$request->data)->get();

        $response =[
            'status' =>'success',
            'sums' =>$result,
        ];

        return response()->json($response,200);
    }

    //monthlySale
    public function monthlySale(Request $request){

        $e = explode('-',$request->months);
        $month =$e[1];
        $year = $e[0];
        logger($year);
        $result = Invoice::select( DB::raw('sum(total_amount) as sums') )
        ->whereYear('created_at','=',$year)
        ->whereMonth('created_at','=',$month)->get();

        logger($result);
        $response=[
            'status' =>'success',
            'result'=> $result,
        ];
        return response()->json($response,200);
    }

    //stock weekly sale
    public function weeklySale(Request $request){

        // $result = Stock_in::select(
        //     DB::raw('sum(qty) as sumOfStock'),
        // )->whereDate('created_at','>=',$request->date1)->whereDate('created_at','<=',$request->date2)
        // ->get();
        $result = Stock_in::select(
            DB::raw('sum(qty) as sumOfStock'),
        )->get();
        $response =[
            'status' =>'success',
            'sumOfStock' => $result,
        ];
        return response()->json($response,200);
    }

    //yearly sale
    public function yearlySale(Request $request){

        $year = $request->year;
        $date =Carbon::now()->year($year);
        $newDate = $date->format('Y-m-d');
        $newMonth = $date->format('Y-m');
        $response =[
            'status' =>'success',
            'date' => $newDate,
            'month' => $newMonth,
        ];
        return response()->json($response,200);
    }
}
