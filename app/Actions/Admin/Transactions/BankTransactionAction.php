<?php

namespace App\Actions\Admin\Transactions;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class BankTransactionAction
{

    public function bankTransfers()
    {
        $alltransaction = Transaction::where('method', 'bank')->orderBy('id', 'desc')->paginate(100);
        return TransactionResource::collection(
            $alltransaction
        );
    }
}