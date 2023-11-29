<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    use ApiResponse;

    public function logout()
    {
        auth()->user()->tokens()->delete();
  
       
        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
