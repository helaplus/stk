<?php

namespace Helaplus\Stk\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StkController extends Controller
{
    public function initiate($amount,$phone,$receiver,$ref,$description,$callbackurl,$commandID="CustomerPayBillOnline"){
            $data = array();
            $data['BusinessShortCode'] = config('stk.shortcode');
            $data['PassKey'] = config('stk.passkey');
            $apiURL = config('stk.endpoint');
            $data['CommandID'] = $commandID;
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
            $response = Http::withHeaders($headers)->withToken(config('stk.helaplus_api_key'))->post($apiURL, $data);
            return $response;
    }
}
