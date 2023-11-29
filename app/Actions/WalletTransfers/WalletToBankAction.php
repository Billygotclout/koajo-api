<?php

namespace App\Actions\WalletTransfers;

use App\Models\Pin;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;
use App\Traits\EncryptionTrait;
use Illuminate\Support\Facades\Http;

class WalletToBankAction
{
    use ApiResponse,  EncryptionTrait, ActivityLogTrait;
    protected $amount;
    const DESCRIPTION = 'MONEY FROM KOAJO';
    const CREDIT = 'credit';
    const METHOD = 'wallet';
    const STATUS = 'pending';

    public function execute(array $data)
    {
        $userId = auth()->user()->id;
        $this->amount = $data['amount'];

        $dbPin = Pin::where('user_id', $userId)->first();
        $decryptedPin = $this->decrypt($dbPin->pin);

        if ($decryptedPin != $data['pin']) {
            return $this->error('incorrect pin', 400);
        }

        $userWallet = Wallet::where('user_id', $userId)->first();
        $userBalance = $userWallet->amount;

        if ($data['amount'] < 2000) {
            return $this->error("Minimum Withdrawal is 2000 naira", 400);
        }

        if ($userBalance < $data['amount']) {
            return $this->error('Wallet amount is insufficient', 400);
        }

      


        $newUserBalance = $userBalance - $data['amount'];

        $this->url = (config('keys.flutterwave.base_url')) . "/transfers";
        $this->secretKey = (config('keys.flutterwave.secret_key'));

        $transfer = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->secretKey}",
        ])->post($this->url, $this->requestPayload())->json();
        dd($transfer);
        if ($transfer['data']['status'] === 'success') {

            #create transaction for sender
            Transaction::create([
                'user_id' => $userId,
                'from' => $userId,
                'amount' => $data['amount'],
                'transferred_to' => 'Bank Account',
                'type' => self::CREDIT,
                'method' => self::METHOD,
                'status' => self::STATUS,
                'reference' => $transfer['data']['reference'],
                'payment_id' => $transfer['data']['id'],
            ]);
        }

        $userWallet->update(['amount' => $newUserBalance]);

        $title = "Wallet to bank Transfer";

        $userActivity = "User successfully initiated transfer to bank";

        $this->createActivityLog($title, $userActivity,$userId);

        return $this->success(null, "{$data['amount']} is being transferred successfully to your bank, you will get a notification once it is successful");
    }

    private function requestPayload()


    {

        $this->bank_code = auth()->user()->payoutAccount->bank_code;


        $this->account_number = auth()->user()->payoutAccount->account_number;

        return [
            "account_bank" => $this->bank_code,
            "account_number" => $this->account_number,
            "amount" => $this->amount,
            "currency" => "NGN",
            "narration" => self::DESCRIPTION
        ];
    }
}
