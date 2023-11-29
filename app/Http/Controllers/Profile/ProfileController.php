<?php

namespace App\Http\Controllers\Profile;

use App\Actions\Profile\GetUserDetailsAction;
use App\Actions\Profile\UpdatePasswordAction;
use App\Actions\Profile\UpdatePinAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Http\Requests\Profile\ChangePinRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function userDetails()
    {
        return (new GetUserDetailsAction)->execute();
    }

    public function changePin(ChangePinRequest $request)
    {
        return (new UpdatePinAction())->execute($request->validated());
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        return (new UpdatePasswordAction)->execute($request->validated());
    }
}
