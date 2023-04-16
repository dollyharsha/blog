<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use App\Models\Users;

class LoginController extends Controller
{
    public function Checklogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',   
            'password' => 'required',

        ]); 
        if ($validator->fails())   
        {
            return response()->json(['error'=>'request has no data','data'=>'All the data is requried']);  
        } 
        else {
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials)) {
             
                 return response()->json(["status"=>true,"redirect_location"=>url("user/dashboard")]);
                    
            } else {
                return response()->json(["statuscode"=>'401','message'=>'Invalid email and password']);
                
            }
    }
}
    public function logout()
    {
        Auth::logout();
        return redirect("login")->with('success', 'Logout successfully');

    }
}
