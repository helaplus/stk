<?php

namespace Helaplus\Stk\Http\Controllers;

use Helaplus\Stk\Models\StkLog;
use Helaplus\Stk\Stk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StkController extends Controller
{
    public function initiate($amount,$phone,$receiver,$ref,$description,$callbackurl,$commandID="CustomerPayBillOnline"){
            $delay = env('STK_DELAY_TIME',0);
            $data = array();
            $data['BusinessShortCode'] = config('stk.shortcode');
            $data['PassKey'] = config('stk.passkey');
            $apiURL = config('stk.endpoint');
            $data['CommandID'] = $commandID;
            $data['delay'] = $delay;
            $data['Password'] = "";
            $data['Timestamp'] = "";
            $data['Amount'] = $amount;
            $data['PartyA'] = $phone;
            $data['PartyB'] = $receiver;
            $data['PhoneNumber'] = $phone;
            $data['CallBackURL'] = $callbackurl;
            $data['AccountReference'] = $ref;
            $data['TransactionDesc'] = $description;
            $headers = [
                'Content-Type: application/json',
            ];
            //log request
            $stklog = self::logRequest($data);
            $response = Http::withHeaders($headers)->withToken(config('stk.helaplus_api_key'))->post($apiURL, $data);
            $response = $response->json();
            if(isset($response['success'])){
                if($response['success'] == 1){
                    $stklog->status = 1;
                    $stklog->response = json_encode($response);
                    $stklog->checkout_request_id = $response['data']['CheckoutRequestID'];
                    $stklog->save();
                }
            }
            return $response;
    }

    public function receiver(Request $request){
        $request = $request->all();
        $stklog = StkLog::whereCheckoutRequestId($request['Body']['stkCallback']['CheckoutRequestID'])->first();
        if($request['Body']['stkCallback']['ResultCode'] == 0){
            $stklog->status = 2;
            $stklog->response = $stklog->response.PHP_EOL.json_encode($request);
            $stklog->save();
        }

        return json_encode(['success'=>1,'data'=>$stklog]);
    }

    public function logRequest($data){
        $stklog = new StkLog();
        $stklog->phone = $data['PartyA'];
        $stklog->amount = $data['Amount'];
        $stklog->ref = $data['AccountReference'];
        $stklog->details = json_encode($data);
        $stklog->save();
        return $stklog;
    }
}
