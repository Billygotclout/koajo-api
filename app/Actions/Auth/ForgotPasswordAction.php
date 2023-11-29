<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordAction
{

    use ApiResponse;


    public function forgotPassword(ForgotPasswordRequest $request, )
    {


        $credentials = $request->validated();

        $userDetails = User::where('email', $credentials)->first();
        
        if(!$userDetails){
            return $this->error('user does not exist', 400);
        }
   
        Password::sendResetLink($credentials);
        return $this->success('Reset password link sent on your email', 200);
    }
}
