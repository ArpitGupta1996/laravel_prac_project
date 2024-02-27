<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class UserController extends Controller
{
    public function register(Request $request){
        // dd('here');
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|numeric|unique:users,phone|min:10',
            'email' => 'required|unique:users,email',
            'avatar' => 'required',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
            'user_role' => 'required|in:admin,user',
            // 'dob' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        else{
           $data= User::create([

                'name' => $request->name,
                'phone' => $request->phone,
                'date' => date("Y-m-d"),
                'email' => $request->email,
                'avatar' => $request->avatar,
                'password' => Hash::make($request->password),
                'user_role' => $request->role
           ]);

           return response()->json(['status' => 200, 'data' =>$data]);
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required | exists:users',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->first()], 400);
        } else{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return response()->json(['status' => 200, 'message' => 'Login Successfully', 'data' => $request->email]);
            }else{
                return response()->json(['status' => 400, 'message' => 'Kindly check your credentials']);

            }
        }
    }

    public function sendsms($mobile){

        // dd("here");
        // dd($mobile);
        $mobileNumber = $mobile;

        $otp_code = rand(1000,9999);

        // $user = User::where('mobile_no', $mobile)->first();

        // $user->opt_code = $otp_code;

        // $user->save();

        $senderId = "QQDSSUR";

        $message = $otp_code."your otp is";

        $route = 430;

        $postData = array(
            'username' => 'qdegree',

            'password' => '7bc845dab5XX',

            'to' => $mobileNumber,

            'message' => $message,

            'sender' => $senderId,

            'route' => $route,

            'reqid' => 1,
        );

        $url = "http://www.cloud.smsplus.in/API/WebSMS/Http/v1.0a/index.php";

        $ch = curl_init();

        curl_setopt_array($ch, array(

            CURLOPT_URL => $url,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS => $postData,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_ENCODING => "",

            CURLOPT_MAXREDIRS => 10,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            CURLOPT_CUSTOMREQUEST => "POST",

            CURLOPT_SSL_VERIFYHOST => 0,

            CURLOPT_SSL_VERIFYPEER => 0,

        ));

        $response = curl_exec($ch);

        $err = curl_error($ch);

        curl_close($ch);

        return $response;
    }
}
