<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function flutterwaveWebhook(Request $request)
    {

        Log::info('I am here to log webhook');


        $requestData = [
            "body" => $request->all(),
            "headers" => getallheaders(),
        ];

        dd($requestData);

        $responseSecretHash = $requestData['verif-hash'];

        $localSecretHash = (config('keys.flutterwave.secret_hash'));

        if ($responseSecretHash != $localSecretHash) {
            Log::info('Hash is not the same');
            return false;
        }

        $event = $requestData['body']['event'];
        Log::info('This is the event: '  . $event);

        if ($event === "transfer.completed") {

            $status = $requestData['body']['data']['status'];

            Log::info('status is logged here' . $status);
           
            $paymentID = $requestData['body']['data']['id'];

            Log::info('payment id is logged here ' . $paymentID);
            
            $transactions = Transaction::where('payment_id', $paymentID);

            if (!$paymentID) {

                Log::info('Payment not found');

                return false;
            }

            if ($status != "SUCCESSFUL") {
                $transactions->update(['status' => 'failed']);
                return false;
            }

            $transactions->update(['status' => 'successful']);
        }

        http_response_code(200);
    }
}
