<?php

namespace App\Actions\AjoSystem;

use App\Models\Ajo;
use App\Models\AjoGroups;
use App\Models\AjoUser;
use App\Models\Wallet;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;


class PayAheadAction
{
    use ApiResponse;
    const STATUS = ["Paid"];

    public function execute()
    {
        $userId = auth()->user()->id;


        $ajoGroupMemberId = AjoGroups::whereJsonContains('members_id', $userId)->first();

        $ajoAmount = $ajoGroupMemberId->amount;


        $wallet = Wallet::where('user_id', $userId)->first();
        $walletAmount = $wallet->amount;

        if ($ajoAmount > $walletAmount) {
            return $this->error("Insufficient amount in wallet, please deposit into your wallet to complete action", 400);
        }


        $ajoUser = AjoUser::where('user_id', $userId)->first();

$paid = array_merge($ajoUser->payment_status, self::STATUS);
        $ajoUser->update(['payment_status' => $paid]);



        return  $this->success("Ajo successfully paid", 201);
    }
}
