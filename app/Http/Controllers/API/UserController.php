<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request){
        // dd('here');
        dd($request->all());
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required | unique:users,email',
            'avatar' => 'required',
            'password' => 'required | min:8',
            'user_role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }else{
           $data= User::create([
              
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => $request->avatar,
                'password' => Hash::make($request->password),
                'user_role' => $request->role
           ]);

           return response()->json(['status' => 200, 'data' =>$data]);
        }
    }
}
