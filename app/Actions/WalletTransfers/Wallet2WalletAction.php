<?php

namespace App\Actions\WalletTransfers;

use App\Models\Pin;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;

class Wallet2WalletAction
{

    use ApiResponse;
    use EncryptionTrait;

    const DEBIT = 'debit';
    const CREDIT = 'credit';
    const METHOD = 'wallet';
    const STATUS = 'successful';
    public function execute(array $data)
    {
        $userId = auth()->user()->id;

        $pin = Pin::where('user_id', $userId)->first();
        $decryptPin = $this->decrypt($pin->pin);

        if ($decryptPin != $data['pin']) {
            return $this->error('incorrect pin', 400);
        }

        $userWallet = Wallet::where('user_id', $userId)->first();
        $userBalance = $userWallet->amount;

        if ($userBalance < $data['amount']) {
           return $this->error("Insufficient Balance", 400);
        }

        $newBalance = $userBalance - $data['amount'];
        $receiver = User::where('phone', $data['receiver_phone'])->first();
        $receiverWallet = Wallet::where('user_id', $receiver->id)->first();
        $newReceiverBalance = $receiverWallet->amount + $data['amount'];

        #create transaction for sender
        Transaction::create([
            'user_id' => $userId,
            'from' => $userId,
            'amount' => $data['amount'],
            'transferred_to' => $receiver->id,
            'type' => self::DEBIT,
            'method' => self::METHOD,
            'status' => self::STATUS
        ]);

        #create transaction for receiver
        Transaction::create([
            'user_id' => $receiver->id,
            'from' => $userId,
            'amount' => $data['amount'],
            'type' => self::CREDIT,
            'method' => self::METHOD,
            'status' => self::STATUS,
            
        ]);


       
        
        $userWallet->update(['amount' => $newBalance]);

        $receiverWallet->update(['amount' => $newReceiverBalance]);
        
        return $this->success(null, "{$data['amount']} has been transferred successfully to {$receiverWallet->user->first_name}");
    }
}
