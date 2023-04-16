<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email',   
        //     'name' => 'required',
        //     'password'=>'requried'

        // ]); 
        // if ($validator->fails())   
        // {
        //     return response()->json(['error'=>'request has no data','data'=>'All the data is requried']);  
        // } 

            $encrypted_password = bcrypt($request->input('password'));
            $request->request->add(['password'=>$encrypted_password]);
            // $data=array('name'=>$request->input('name'),'email'=>$request->input('email'),'password'=>$encrypted_password);

        User::create($request->all());

        return response()->json(['success'=>'User Registered succesfully.',"redirect_location"=>url("login")]);

    }
}
