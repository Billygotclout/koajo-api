<?php

return [

    // the sms key belongs to Africa's Talking
    'sms' => [
        'account_id' => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'sender' => env('TWILIO_FROM'),
        
    ],

    // mono
    'mono' => [
        'base_url' => env('MONO_BASE_URL'),
        'secret_key' => env('MONO_SECRET_KEY'),
    ],

    //flutterwave
    'flutterwave' =>[
        'base_url' => env('FLUTTERWAVE_BASE_URL', 'https://api.flutterwave.com/v3'),
        'secret_key' => env('FLUTTERWAVE_SECRET_KEY'),
        'secret_hash' => env('SECRET_HASH')
    ]

];