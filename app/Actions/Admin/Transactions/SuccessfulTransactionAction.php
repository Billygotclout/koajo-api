<?php

namespace App\Actions\Admin\Transactions;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class SuccessfulTransactionAction
{
    public function successfulTransfers()
    {
        $alltransaction = Transaction::where('status', 'successful')->orderBy('id', 'desc')->paginate(100);
        return TransactionResource::collection(
            $alltransaction
        );
    }
}