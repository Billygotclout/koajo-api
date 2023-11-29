<?php

namespace App\Actions\Admin\Transactions;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class CreditTransactionAction
{
    public function creditTransfers()
    {
        $alltransaction = Transaction::where('type', 'credit')->orderBy('id', 'desc')->paginate(100);
        return TransactionResource::collection(
            $alltransaction
        );
    }
}