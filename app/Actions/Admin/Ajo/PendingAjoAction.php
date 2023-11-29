<?php

namespace App\Actions\Admin\Ajo;

use App\Http\Resources\AjoResource;
use App\Models\Ajo;

class PendingAjoAction
{

    public function pendingAjo()
    {
        $pendingAjo =  Ajo::where('status', 'pending')->orderBy('id', 'desc')->paginate(100);

        return AjoResource::collection($pendingAjo);
    }
}
