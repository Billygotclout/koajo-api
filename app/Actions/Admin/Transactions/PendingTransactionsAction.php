<?php

namespace App\Actions\Admin\Transactions;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class PendingTransactionsAction
{
    public function pendingTransfers()
    {
        $alltransaction = Transaction::where('status', 'pending')->orderBy('id', 'desc')->paginate(100);
        return TransactionResource::collection(
            $alltransaction
        );
    }
}