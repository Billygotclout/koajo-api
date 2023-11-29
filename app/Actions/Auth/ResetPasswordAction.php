<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class ResetPasswordAction
{

    use ApiResponse;
    use EncryptionTrait;


    public function resetPassword(ResetPasswordRequest $request)
    {
        $resetPasswordStatus = Password::reset($request->validated(), function ($user, $password) {
            $user->password = Hash::make($password) ;
            $user->save();
        });

        if ($resetPasswordStatus == Password::INVALID_TOKEN) {
            return $this->error('invalid reset password token', 401);
        }

        return $this->success("Password has been successfully changed", 200);
    }

         
    }

