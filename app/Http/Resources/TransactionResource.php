<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'reference' => $this->reference,
            'type' => $this->type,
            'method' => $this->method,
            'status' => $this->status,
            'user' => $this->user,
            'from_user' => $this->fromUser,
            'to_user' => $this->toUser,
        ];
    }
}
