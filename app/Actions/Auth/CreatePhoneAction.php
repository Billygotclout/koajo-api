<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;
use App\Traits\SmsTrait;
use Illuminate\Support\Facades\Http;
use GuzzleHttp;

class CreatePhoneAction
{

    use ApiResponse;
    use EncryptionTrait;
    use SmsTrait;




    public function __construct()
    {
    }

    public function execute(array $data)
    {

        $user = $this->checkPhoneNumber($data['phone']);

        if (isset($user->email)) {
            return $this->error('User already exist, please login', 400);
        }

        $verificationCode = $this->getVerificationCode();

        User::updateOrCreate(
            ['phone' =>  $data['phone']],
            ['verification_code' => $this->encrypt($verificationCode)]
        );

        $message = "Your Koajo verification code is: {$verificationCode}";

        // $this->sendSms($message, $data['phone']);


        return $this->success([
            'phone' => $data['phone'],
            'verification_code' => $verificationCode,
        ], 'A six digit code has been sent to your registered phone number, use it to confirm');
    }

    private function getVerificationCode()
    {
        return random_int(111111, 999999);
    }

    public function checkPhoneNumber($phone)
    {
        return User::where('phone', $phone)->first();
    }
}
