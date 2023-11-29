<?php


namespace App\Actions\Payment;

use App\Http\Resources\CardDetailsResource;
use App\Traits\ApiResponse;

class GetCardDetailsAction
{

    use ApiResponse;


    public function execute()
    {
 
        return $this->success(new CardDetailsResource(auth()->user()->cardDetails));
    }
}
