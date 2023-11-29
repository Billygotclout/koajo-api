<?php

namespace App\Actions\Auth;


use App\Http\Resources\UserResource;
use App\Models\Imei;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;

class RegisterAction
{

    use ApiResponse;
    use ActivityLogTrait;

    protected $user;
    protected $username;
    protected $data;

    public function execute(array $data)
    {


        $this->data = $data;

        $this->username = $this->assignUsername();

        $this->user = User::where('id', $data['user_id'])->first();

        $this->user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $this->username,
            'password' => bcrypt($data['password']),
            'email' => $data['email']
        ]);


        // $this->user->sendEmailVerificationNotification();

        $title = "Registration";

        $userActivity = "{$this->user['first_name']} has registered";

        $this->createActivityLog($title, $userActivity, $this->user->id);

        $this->createWallet();

        return $this->success([
            'token' => $this->user->createToken('API Token')->plainTextToken,
            'user_details' => new UserResource($this->user),

        ], "A link has successfully been sent to your email, click on the link to verify your email",  201);
    }

    private function assignUsername()
    {
        $username = substr(str_replace(' ', '', strtolower($this->data['first_name'])), 0, 5) . rand(1, 9);

        $checkUsername = User::where('username', $username)->first();
        if ($checkUsername) {
            $this->assignUsername();
        }

        return $username;
    }

    private function createWallet()
    {
        $wallet = new Wallet();
        $wallet->user_id = $this->user->id;
        $wallet->save();
    }
}
