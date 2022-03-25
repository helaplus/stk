<?php

return [
    //shortcode
    'shortcode' => env('STK_SHORTCODE'),

    //password
    'password' => env('STK_PASSWORD'),

    //passkey
    'passKey' => env('STK_PASSKEY'),

    //stk endpoint
    'endpoint' => env('STK_ENDPOINT','https://sandbox.api.helaplus.com/v1/mpesa/initiateStk'),

    //helaplus api key
    'helaplus_api_key' => env('HELAPLUS_API_KEY'),


];
