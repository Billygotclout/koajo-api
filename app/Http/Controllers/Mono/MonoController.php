<?php

namespace App\Http\Controllers\Mono;


use App\Actions\Mono\MonoVerificationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mono\MonoVerificationRequest;
use Illuminate\Http\Request;

class MonoController extends Controller
{

    public function monoVerify(MonoVerificationRequest $request)
    {
        return (new MonoVerificationAction())->execute($request->validated());
    }
}
