<?php

namespace App\Http\Controllers\Auth;


use App\Actions\Auth\CreatePinAction;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreatePinRequest;
use App\Models\User;

class PinController extends Controller
{
    use ApiResponse;

    public function create(CreatePinRequest $request)
    {
      
       
        return (new CreatePinAction())->execute($request->validated());
    }
}
