<?php

namespace App\Actions\Mono;


use App\Models\BankDetails;
use App\Models\CustomerIdentification;
use App\Models\UserIncome;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Http;

class MonoVerificationAction
{

    use ApiResponse;
 

    protected $secret;
    protected $url;
    protected $data;
    const TYPE = 'mono';
    const STATUS = 'verified';

    public function __construct()
    {
        $this->secret = (config('keys.mono.secret_key'));
        $this->url = (config('keys.mono.base_url'));
    }
    

    public function execute(array $data)
    { 
        
        $this->data = $data;

        $payload = [
            'code' => $this->data['mono_code']
        ];

        $getId = Http::withOptions(['verify' => false])->withHeaders([
            'Content-Type' => 'application/json',
            'mono-sec-key' => "{$this->secret}"
        ])->post($this->url. '/account/auth', $payload)->json();

        if(!isset($getId['id'])){
            return $this->error(
                "You are using an invalid or expired code",
                401
            );
        }

        CustomerIdentification::create([
            'user_id' => $this->data['user_id'],
            'customer_id' => $getId['id'],
            'type' => self::TYPE
        ]);

      

      

        $this->getIncome($getId['id']);

        return $this->success(null, 'mono customer created successfully', 201);
    }

    

    private function getIncome($monoAccountId)
    {
        $income = Http::withOptions(['verify' => false])->withHeaders([
            'Content-Type' => 'application/json',
            'mono-sec-key' => "{$this->secret}"
        ])->get($this->url. "/accounts/{$monoAccountId}/income")->json();

        UserIncome::create([
            'user_id' => $this->data['user_id'],
            'type' => $income['type'],
            'amount' => $income['amount']/100, //convert amount to Naira
            'confidence' => $income['confidence'],
        ]);

        return true;
    }
}
