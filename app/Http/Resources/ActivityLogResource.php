<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
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
            'ip_address' => $this->first_name,
            'device' => $this->device,
            'activities' => $this->activities,
            'user_id' => $this->user_id,
            
            
        ];
    }
}
