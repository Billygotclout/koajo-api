<?php

namespace App\Actions\Admin\Ajo;

use App\Http\Resources\AjoResource;
use App\Models\Ajo;

class AllAjoAction
{

    public function allAjos()
    {
        $allAjo =  Ajo::orderBy('id', 'desc')->paginate(100);

        return AjoResource::collection($allAjo);
    }
}
