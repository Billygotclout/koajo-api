<?php

namespace App\Http\Resources;


use App\Traits\EncryptionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class CardDetailsResource extends JsonResource
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
        // dd($this->first_6digits);
        return [
            'id' => $this->encrypt($this->id),
            'first_6digits' => $this->first_6digits,
            'last_4digits' => $this->last_4digits,
            'expiry' => $this->expiry,
            'type' => $this->type,
            'user_id' => $this->encrypt($this->user_id),
            
        ];
    }
}
