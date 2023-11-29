<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;
use App\Traits\SmsTrait;
use Illuminate\Support\Facades\Http;
use GuzzleHttp;


class ResendCodeAction
{

    use ApiResponse;
    use EncryptionTrait;
    use SmsTrait;
  
    
   

    public function __construct()
    {
        
    }

    public function execute(array $data)
    { 
        
        $verificationCode = $this->getVerificationCode();
        
        User::where('phone', $data['phone'])->update([
            'verification_code' => $this->encrypt($verificationCode)
        ]);

        $message = "Your Koajo verification code is: {$verificationCode}";
            
        $this->sendSms($message, $data['phone']);
        

    

        return $this->success([
            'phone' => $data['phone'],
            'verification_code' => $verificationCode,
        ], 'A six digit code has been sent to your registered phone number, use it to confirm your phone number');
    }

    private function getVerificationCode()
    {
        return random_int(111111, 999999);
    }
}
