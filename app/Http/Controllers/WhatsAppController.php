<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Exception;

class WhatsAppController extends Controller
{
    public function index()
    {
        return view('whatsapp');
    }

    public function store(Request $request)
    {
        // $twilioSid = env('TWILIO_SID');
        // $twilioToken = env('TWILIO_TOKEN');
        // $twilioWhatsAppNumber = env('TWILIO_PHONE');

        // $recipientNumber = $request->phone;

        // $message = $request->message;

        // try {
        //     $twilio = new Client($twilioSid, $twilioToken);
        //     $twilio->messages->create(
        //         $recipientNumber,
        //         [
        //             "from" => "whatsapp:+" . $twilioWhatsAppNumber,
        //             "body" => $message,
        //         ]
        //     );

        //     return back()->with(['success' => 'WhatsApp message sent successfully!']);
        // } catch (Exception $e) {
        //     return back()->with(['error' => $e->getMessage()]);
        // }



        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_TOKEN");
        $sendernumber = getenv("TWILIO_PHONE");

        $twilio = new Client($sid, $token);

        $verification = $twilio->verify->v2->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                           ->verifications
                                           ->create("+17743326277", "sms");

        $service = $twilio->verify->v2->services
            ->create("My First Verify Service",[
                "body" => "test message",  

                "from" => $sendernumber
            ]);

        print($service->sid);
    }
}
