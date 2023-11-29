<?php
namespace App\Actions\WalletTransfers;

use App\Models\User;
use App\Traits\ActivityLogTrait;
use App\Traits\ApiResponse;

class VerifyUserWalletAction 
{

    use ApiResponse;
    use ActivityLogTrait;

    public function execute ($data)
    {
          
        $firstString = $data[0];
        if($firstString == 0){
            $data = "+234" . ltrim($data, 0);
        }
       
        $userId = auth()->user()->id;

        $userDetails = User::where('phone', $data)
        ->orWhere('username', $data)->first();

        $title ="wallet user verification";

        $userActivity = "{$userDetails->first_name} is verifying wallet for {$data} ";

        $this->createActivityLog($title,$userActivity, $userId);
     
        if(!$userDetails){
            return $this->error('user does not exist', 400);
        }

        return $this->success($userDetails,'user fetched successfully');
    }

}