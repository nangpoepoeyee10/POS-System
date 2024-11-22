<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function createuserApi(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],true)){
            $data = User::select('id','name','email','image','role')
            ->where('email',$request->email)->first();

            $token =$request->user()->createToken($request->token_name)->plainTextToken;

            return response()->json(["status" => true,"message"=>$token,$data],200);
        }
       else{
            return response()->json(["status" => false,"message" => "Email is not existed"],200);
        }

    }

}

