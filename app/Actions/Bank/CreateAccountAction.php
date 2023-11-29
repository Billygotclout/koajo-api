<?php


namespace App\Actions\Bank;

use App\Models\Bank;
use App\Models\PayoutAccount;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CreateAccountAction
{

    use ApiResponse;

    protected $data;
    const STATUS = 'active';

    public function execute(array $data): JsonResponse
    {
        $this->data = (object) $data;


        $this->url = (config('keys.flutterwave.base_url')) . "/accounts/resolve";
        $this->secretKey = (config('keys.flutterwave.secret_key'));





        $payload = [

            "account_number" => "0690000032",
            "account_bank" => "044"

        ];

        $accountDetails = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->secretKey}",
        ])->post($this->url, $payload)->json();


        PayoutAccount::create([
            'user_id' => auth()->user()->id,
            'bank_name' => $this->getBank()->bank_name,
            'bank_id' => $this->getBank()->id,
            'bank_code' => $data['bank_code'],
            'account_name' => $accountDetails['data']['account_name'],
            'account_number' => $data['account_number'],
            'status' => self::STATUS,

        ]);



        return $this->success(null, 'account created successfully', 201);
    }
private function getBank()
    {
        $bank = Bank::where('bank_code', $this->data->bank_code)->first();

        return $bank;
    }
}
