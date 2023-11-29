<?php


namespace App\Actions\Auth;

use App\Models\Pin;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;

class CheckPinAction
{

    use ApiResponse;
    use EncryptionTrait;

    public function verifyPin(array $data)
    {
        $userId = $data['user_id'];

        $user = Pin::where('user_id', $userId)->first();

        if (!$user) {
            return $this->error(
                "user has no pin",
                400
            );
        }

        $encryptedUserPin = $user->pin;
        $decryptedPin = $this->decrypt($encryptedUserPin);

        if ($decryptedPin !== $data['pin']) {
            return $this->error(
                "pin is Incorrect",
                401
            );
        }

        return $this->success(" Pin is correct", null, 200);
    }
}
