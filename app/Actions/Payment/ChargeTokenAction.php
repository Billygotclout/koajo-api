<?php

namespace App\Actions\Payment;

use App\Models\CardDetails;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\ApiResponse;
use App\Traits\FlutterwavePaybackFeeTrait;
use Illuminate\Support\Facades\Http;

class ChargeTokenAction
{
    use ApiResponse ;


    const CURRENCY = 'NGN';
    const COUNTRY = 'NG';
    const DEBIT = 'debit';
    const METHOD = 'bank';
    const STATUS = 'successful';

    public function execute($data)
    {

        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->first();

        // dd($user['first_name']);
        $this->url = (config('keys.flutterwave.base_url')) . "/tokenized-charges";
        $this->secretKey = (config('keys.flutterwave.secret_key'));

        $chargeToken =  Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->secretKey}"
        ])->post($this->url, $this->requestPayload($data['amount']));
        

        if ($chargeToken['status'] === 'success') {


            Transaction::create([
                'user_id' => $userId,
                'from' => $user['first_name'],
                'amount' => $data['amount'],
                'transferred_to' => 'FlutterWave Account',
                'type' => self::DEBIT,
                'method' => self::METHOD,
                'status' => self::STATUS,
                'reference' => $chargeToken['data']['tx_ref'],
                'payment_id' => $chargeToken['data']['id'],
            ]);
        }

        return $this->success($chargeToken['status'], "Card successfully charged", 200);
    }
    private function requestPayload($amount)


    {

        $userId = auth()->user()->id;
        
        
        $dbToken = CardDetails::where('user_id', $userId)->first();
        $this->token = $dbToken->token;
       

   
        return [
            "token" => $this->token,
            "email" => $dbToken->email,
            "amount" => $amount,
            "currency" => self::CURRENCY,
            "country" => self::COUNTRY,
            "tx_ref" => "tx_" . substr(rand(0, time()), 0, 7)

        ];
    }
}
