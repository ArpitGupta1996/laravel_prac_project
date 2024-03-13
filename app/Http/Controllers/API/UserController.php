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

        // return $otp_code;

        // $user = User::where('mobile_no', $mobile)->first();

        // $user->opt_code = $otp_code;

        // $user->save();

        $senderId = "QDSSUR";

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

        // return $postData;

        $url = "http://www.cloud.smsplus.in/API/WebSMS/Http/v1.0a/index.php";

        $ch = curl_init();

        // dd($ch);

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

        // dd($response);

        $err = curl_error($ch);
        // dd($err);

        curl_close($ch);

        return $response;
    }


    public function sendsmsold($mobile,$msg,$otp_code) {

        // return $mobile;
        $message=$otp_code." ".$msg;

        // return $message;
        $xml_data ='<?xml version="1.0"?>
                    <smslist>
                    <sms>
                    <user>qdegree</user>
                    <password>7bc845dab5XX</password>
                    <message>'.$message.'</message>
                    <mobiles>'.$mobile.'</mobiles>
                    <senderid>QDSSUR</senderid>
                        <accusage>1</accusage>
                        <responsein>csv</responsein>
                    </sms>
                    </smslist>';
        $URL = "http://sms.smsmenow.in/sendsms.jsp?";
        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);

        //curl_close($ch);
        //$response = curl_exec($ch);
        // print_r($response);die;
        $err = curl_error($ch);
        curl_close($ch);
        return true;
           /* if ($err) {
                $model = new \frontend\modules\nps\models\SmsLog();
                $model->details = "cURL Error #:" . $err.$response.'---'.$response_id;
                ;
                $model->status = 0;
                $model->save(false);
                //echo "cURL Error #:" . $err;
            } else {
                $model = new \frontend\modules\nps\models\SmsLog();
                $model->details = $response.'---'.$response_id;
                $model->status = 1;
                $model->save(false);
                //echo $response;
            }*/
        //print_r($output); die;
    }
}
