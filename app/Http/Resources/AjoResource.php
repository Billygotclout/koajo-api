<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AjoResource extends JsonResource
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
            'amount' => $this->amount,
            'status' => $this->status,
            'user_id' => $this->user_id,
           
            
        ];
    }
}
