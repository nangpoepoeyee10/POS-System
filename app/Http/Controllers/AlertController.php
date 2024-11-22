<?php

namespace App\Http\Controllers;

use App\Models\alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    //
    public function alertStock(Request $request){
        $qty = $request->alert;
        $query= alert::first();
        if($query){
            $alert = ['qty' => $qty] ;
           alert::where('id',1)->update($alert);
        }else{
            $alert = ['qty' => $qty] ;
            alert::create($alert);
        }
        return redirect()->route('inventory');
    }

}
