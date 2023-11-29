<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Ajo\ActiveAjoAction;
use App\Actions\Admin\Ajo\AllAjoAction;
use App\Actions\Admin\Ajo\CompletedAjoAction;
use App\Actions\Admin\Ajo\PendingAjoAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjosController extends Controller
{
    public function all()
    {
        return (new AllAjoAction)->allAjos();
    }
    public function active()
    {
        return (new ActiveAjoAction)->activeAjo();
    }
    public function pending()
    {
        return (new PendingAjoAction)->pendingAjo();
    }
    public function completed()
    {
        return (new CompletedAjoAction)->completedAjo();
    }
}
