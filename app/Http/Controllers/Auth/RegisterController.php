<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CheckPinAction;
use App\Actions\Auth\CreatePhoneAction;
use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\ResendCodeAction;
use App\Actions\Auth\VerifyCodeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckPinRequest;
use App\Http\Requests\Auth\PhoneNumberRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyCodeRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Http\Requests\Auth\VerifyPhoneNumberRequest;
use App\Models\ActivityLog;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use ApiResponse;

    public function getPhoneNumber(PhoneNumberRequest $request)
    {
        return (new CreatePhoneAction())->execute($request->validated());
    }
    public function register(RegisterRequest $request): JsonResponse
    {

        return (new RegisterAction(new ActivityLog()))->execute($request->validated());
    }
    public function verifyCode(VerifyCodeRequest $request): JsonResponse
    {
        return (new VerifyCodeAction())->execute($request->validated());
    }
    public function resendCode(VerifyPhoneNumberRequest $request)
    {
        return (new ResendCodeAction())->execute($request->validated());
    }
    public function checkPin(CheckPinRequest $request)
    {
        return (new CheckPinAction())->verifyPin($request->validated());
    }

    public function verifyEmail(VerifyEmailRequest $request)
    {
        return $this->success(null, 200);
    }
}
