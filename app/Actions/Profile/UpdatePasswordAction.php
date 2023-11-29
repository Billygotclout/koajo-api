<?php


namespace App\Actions\Profile;

use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordAction
{
    use EncryptionTrait;
    use ApiResponse;


    public function execute(array $data)
    {
        $UserEmail = auth()->user()->email;

        $payload = [
            'email' => $UserEmail,
            'password' => $data['current_password']
        ];

        if (!Auth::guard('web')->attempt($payload)) {
            return $this->error('Credentials do not match our records', 401);
        }

        
        User::where('email', $UserEmail)
            ->update([
                'password' => bcrypt($data['new_password'])
            ]);

        return $this->success(null, 'password updated successfully', 201);
    }
}
