<?php


namespace App\Actions\Admin\Transactions;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class WalletTransactionAction
{
    public function walletTransfers()
    {
        $alltransaction = Transaction::where('method', 'wallet')->orderBy('id', 'desc')->paginate(100);
        return TransactionResource::collection(
            $alltransaction
        );
    }
}
