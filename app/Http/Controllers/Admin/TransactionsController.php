<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Transactions\AllTransactionAction;
use App\Actions\Admin\Transactions\BankTransactionAction;
use App\Actions\Admin\Transactions\CreditTransactionAction;
use App\Actions\Admin\Transactions\DebitTransactionAction;
use App\Actions\Admin\Transactions\PendingTransactionsAction;
use App\Actions\Admin\Transactions\SuccessfulTransactionAction;
use App\Actions\Admin\Transactions\WalletTransactionAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function allTransactions()
    {
        return (new AllTransactionAction)->allTransfers();
    }

    public function creditTransactions()
    {
        return (new CreditTransactionAction)->creditTransfers();
    }

    public function debitTransactions()
    {
        return (new DebitTransactionAction)->debitTransfers();
    }

    public function walletTransactions()
    {
        return (new WalletTransactionAction)->walletTransfers();
    }

    public function bankTransactions()
    {
        return (new BankTransactionAction)->bankTransfers();
    }

    public function pendingTransactions()
    {
        return (new PendingTransactionsAction)->pendingTransfers();
    }

    public function successfulTransactions()
    {
        return (new SuccessfulTransactionAction())->successfulTransfers();
    }
}
