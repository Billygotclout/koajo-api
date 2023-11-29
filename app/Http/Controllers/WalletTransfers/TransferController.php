<?php

namespace App\Http\Controllers\WalletTransfers;

use App\Actions\WalletTransfers\VerifyUserWalletAction;
use App\Actions\WalletTransfers\Wallet2WalletAction;
use App\Actions\WalletTransfers\WalletToBankAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\WalletTransfers\Wallet2WalletRequest;
use App\Http\Requests\WalletTransfers\WalletToBankRequest;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function verifyWalletUser(Request $request)
    {
      
        $search = $request->query('search');

        return (new VerifyUserWalletAction)->execute($search);
    }

    public function wallet2WalletTransfer(Wallet2WalletRequest $request)
    {
        return (new Wallet2WalletAction)->execute($request->validated());
    }
    public function walletToBank(WalletToBankRequest $request)
    {
        return (new WalletToBankAction())->execute($request->validated());
    }
}
