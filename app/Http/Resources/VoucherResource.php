<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pallyUser_id' => $this->voucherUser_id,
            'loan_id' => $this->ajo_id,
            'status' => $this->status,
            'user_id' => $this->user_id,
           
        ];
    }
}
