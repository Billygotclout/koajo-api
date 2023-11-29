<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LoginAction;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\ActivityLog;
use App\Traits\EncryptionTrait;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    use ApiResponse;
    use EncryptionTrait;

    public function login(LoginRequest $request)
    {
        return (new LoginAction())->execute($request->validated());
    }

    public function encrypt($id)
    {
        return (Crypt::encrypt($id));
    }

    
}
