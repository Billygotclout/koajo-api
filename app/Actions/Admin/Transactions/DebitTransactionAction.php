<?php

namespace App\Actions\Admin\Transactions;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class DebitTransactionAction
{

    public function debitTransfers()
    {
        $alltransaction = Transaction::where('type', 'debit')->orderBy('id', 'desc')->paginate(100);
        return TransactionResource::collection(
            $alltransaction
        );
    }
}