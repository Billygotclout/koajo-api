<?php

namespace App\Http\Controllers\Payouts;

use App\Actions\Bank\BankListAction;
use App\Actions\Bank\CreateAccountAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bank\CreateAccountRequest;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function bankList()
    {
        return (new BankListAction)->execute();
    }

    public function createAccount(CreateAccountRequest $request)
    {
        return (new CreateAccountAction())->execute($request->validated());
    }
}
