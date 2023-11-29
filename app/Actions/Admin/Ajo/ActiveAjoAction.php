<?php

namespace App\Actions\Admin\Ajo;

use App\Http\Resources\AjoResource;
use App\Models\Ajo;

class ActiveAjoAction{

    public function activeAjo()
    {
        $activeAjo =  Ajo::where('status', 'active')->orderBy('id', 'desc')->paginate(100);

        return AjoResource::collection($activeAjo);
    }

}