<?php


namespace App\Actions\Profile;

use App\Models\Pin;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;

class UpdatePinAction
{
    use EncryptionTrait;
    use ApiResponse;

    public function execute(array $data)
    {
        $userId = auth()->user()->id;

        $userPin = Pin::where('user_id', $userId)->first();

        $oldPin = $userPin->pin;

        $decryptOldPin = $this->decrypt($oldPin);

        if ($decryptOldPin != $data['current_pin']) {
            return $this->error('current pin is not valid', 400);
        }

        $userPin->update(['pin' => $this->encrypt($data['new_pin'])]);

        return $this->success(null, 'pin updated successfully', 200);
    }
}
