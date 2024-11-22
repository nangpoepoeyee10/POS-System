<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //profilePage
    public function profilePage(){
        return view('admin.user.profile');
    }

    //changePassword
    public function changePassword(Request $request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:8',
            'newPassword' =>'required|min:8',
            'confirmPassword' =>'required|min:8|same:newPassword',
        ],[])->validate();
        $data = User::select('password')->where('id',$request->userId)->first();
        $dataHash =$data['password'];
        if(Hash::check($request->oldPassword,$dataHash)){
            $requestHash = Hash::make($request->newPassword);
            User::where('id',$request->userId)->update(['password' => $requestHash]);
            toast('change password successful','success');
            return back()->with(['message'=>'change password successful']);
        }
        else{
            toast('change password unsuccess','error');
            return back()->with(['unmessage'=>'change password unsuccessful']);
        }
    }
    public function updateProfile(Request $request){
        // dd($request->toArray());
        // Validator::make($request->all(),[
        //    // 'name'=>'required',
        //     'email' => 'required|unique:users,email,'.$request->userId,
        //    // 'gender' => 'required'
        // ],[])->validate();
        $data =[
            'name' =>$request->name,
            'email' => $request->email,
            'gender' => $request->gender,
        ];
        // if($request->hasFile('image')){

        //     $dbImage = User::where('id',$request->userId)->first();
        //     $dbImage= $dbImage->image;
        //     if($dbImage != null){
        //         Storage::delete('public/'.$dbImage);
        //     }
        //     $image = uniqid().$request->file('image')->getClientOriginalName();
        //     $request->file('image')->storeAs('public',$image);
        //     $data['image'] =$image;
        // }
        if (isset($request->image)) {
            $imageData = file_get_contents($request->image);
            $base64Image = base64_encode($imageData);
            $data['image'] = $base64Image;
        }

        User::where('id',$request->userId)->update($data);
        toast('profile updated successfully','success');
        return back()->with(['message'=>'profile changed successfully']);
    }
}
