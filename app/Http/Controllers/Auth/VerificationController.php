<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

class VerificationController extends Controller
{



    public function verify(Request $request)
    {

        if (!$request->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided"], 401);
        }

        $this->user =  User::findOrFail($request->id);

        
        if (!$this->user->hasVerifiedEmail()) {
            $this->user->markEmailAsVerified();
        }



        $this->user->update(['status' => 'active']);
        return view('Auth.verified');
    }

    public function resend(Request $request)
    {
        $this->user = User::where('email', $request['email'])->first();

        if ($this->user->hasVerifiedEmail()) {
            return response()->json(["msg" => "Email has already been verified"], 400);
        }

        $this->user->sendEmailVerificationNotification();

        return response()->json(["msg" => "Email verification link has been sent to you email"]);
    }
}
