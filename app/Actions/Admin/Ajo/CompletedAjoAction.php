<?php

namespace App\Actions\Admin\Ajo;

use App\Http\Resources\AjoResource;
use App\Models\Ajo;

class CompletedAjoAction
{


    public function completedAjo()
    {
        $completedAjo =  Ajo::where('status', 'completed')->orderBy('id', 'desc')->paginate(100);

        return AjoResource::collection($completedAjo);
    }
}
