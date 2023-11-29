<?php

namespace App\Actions\Profile;

use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;

class GetUserDetailsAction

{
    use ApiResponse;


    public function execute()
    {
        return $this->success(new UserResource(auth()->user()));
    }
}