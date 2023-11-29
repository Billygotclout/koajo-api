<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\ForgotPasswordAction;
use App\Actions\Auth\ResetPasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function forgotPassword (ForgotPasswordRequest $request)
    {
        return (new ForgotPasswordAction)->forgotPassword($request);
    }

    public function resetPassword(ResetPasswordRequest $request) {
        return (new ResetPasswordAction)->resetPassword($request);
    }
}
