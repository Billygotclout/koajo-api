<?php

namespace App\Actions\AjoSystem;

use App\Models\UserIncome;
use App\Traits\ApiResponse;

class MaxAjoJoinAction
{

    use ApiResponse;

    public function execute()
    {
        $user_id = auth()->user()->id;

        $userIncome = UserIncome::where('user_id', $user_id)->first();

        $maxAjoCanJoin = ($userIncome->amount * $userIncome->confidence) / 2;

        return $this->success(['max_amount_user_can_join' => $maxAjoCanJoin], 'maximum amount ajo a user can join');
    }
}
