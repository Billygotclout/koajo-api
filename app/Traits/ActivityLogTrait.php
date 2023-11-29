<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Jenssegers\Agent\Agent;
use App\Jobs\ActivityLogJob;

trait ActivityLogTrait
{
    

    public function createActivityLog($title, $userActivity,$user_id)
    {
        $agent = new Agent();
        
       ActivityLog::create([
            'device' => $agent->device(),
            'ip_address' => \Request::ip(),
            'user_id' => $user_id,
            'title' => $title,
            'activities' => $userActivity
        ]);
    }
}
