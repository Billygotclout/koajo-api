<?php

namespace App\Http\Resources;

use App\Traits\EncryptionTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class AjoResource extends JsonResource
{
    use EncryptionTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->encrypt($this->id),
            'title' => $this->title,
            'ajo_amount' => $this->ajo_amount,
            'number_of_people' => $this->number_of_people,
            'payment_schedule' => $this->payment_schedule,
            'type' => $this->type,
            'status' => $this->status,
            'code' => $this->code,
            'user_id' => $this->user_id,
            'Ajo_users' => $this->ajoUsers
           
            
        ];
    }
}
