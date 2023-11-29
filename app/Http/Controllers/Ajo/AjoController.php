<?php

namespace App\Http\Controllers\Ajo;

use App\Actions\AjoSystem\CreateAjoAction;
use App\Actions\AjoSystem\JoinAjoAction;
use App\Http\Controllers\Controller;
use App\Actions\AjoSystem\MaxAjoJoinAction;

use App\Http\Requests\Ajo\CreateAjoRequest;
use App\Http\Requests\Ajo\JoinAjoRequest;
use App\Traits\ApiResponse;

class AjoController extends Controller
{

    use ApiResponse;


    public function createAjo(CreateAjoRequest $request)
    {
        

        return (new CreateAjoAction)->execute($request->validated());
    }
    public function joinAjo(JoinAjoRequest $request)
    {
        // dd($request);
        // return (new JoinAjoAction)->joinAjo($request->validated());
        return (new JoinAjoAction)->joinAjo($request->validated());
    }
    public function checkMaxAjoAmount()
    {

        return (new MaxAjoJoinAction)->execute();
    }
}
