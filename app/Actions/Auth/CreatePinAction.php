<?php

namespace App\Actions\Auth;


use App\Models\Pin;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;

class CreatePinAction
{
use ActivityLogTrait;
    use EncryptionTrait;
    use ApiResponse;

    public function execute(array $data)
    {
        Pin::create([
            'user_id' => $data['user_id'],
            'pin' => $this->encrypt($data['pin'])
        ]);
        $title = "Pin Creation";
        
        $userActivity = "User successfully created pin";

        $this->createActivityLog($title, $userActivity,$data['user_id']);

        return $this->success(null,'pin created', 201);
    }

    
}
