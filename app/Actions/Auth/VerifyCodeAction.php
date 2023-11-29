<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;
use GuzzleHttp;

class VerifyCodeAction
{

    use ApiResponse;
    use EncryptionTrait;


    public function execute(array $data)
    {

        $phoneNumber = $data['phone'];

        $verifyPhoneNumber = $this->checkPhoneNumber($phoneNumber);
        if (!$verifyPhoneNumber) {
            return $this->error('phone no not found', 400);
        }

        $encryptedCode = $verifyPhoneNumber->verification_code;

        $decryptedCode = $this->decrypt($encryptedCode);

        if ($decryptedCode !== $data['code']) {
            return $this->error('code does not match the one sent to phone number', 400);
        }

        $currentDate = strtotime(now());
        $sentTime = $verifyPhoneNumber->updated_at;
        $userLastActivity = strtotime($sentTime);
        $timeDiffrence = round(abs($currentDate - $userLastActivity) / 60); //diffrence of time in minutes

        if($timeDiffrence > 9){
            return $this->error('code had expired', 401);
        }
        
        return $this->success(['user_id' => $this->encrypt($verifyPhoneNumber->id)]
        ,'code confirmed successfully, proceed to registration');

    }

    private function checkPhoneNumber(string $phoneNumber)
    {
        return User::where('phone', $phoneNumber)->first();
    }
}
