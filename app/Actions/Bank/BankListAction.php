<?php


namespace App\Actions\Bank;

use App\Models\Bank;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use PHPUnit\Framework\MockObject\Api;

class BankListAction
{

    use ApiResponse;
    
    public function execute(): JsonResponse
    {
        $banks = Bank::all();

        return $this->success(['banks' => $banks]);
    }


}