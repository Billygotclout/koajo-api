<?php

namespace App\Http\Resources;

use App\Traits\EncryptionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use EncryptionTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->encrypt($this->id),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'username' => $this->username,
            'phone' => $this->phone,
            'status' => $this->status,
            'wallet' => $this->wallet,
            'payout_account' => $this->payoutAccount,
          

        ];
    }
}
