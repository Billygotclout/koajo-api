<?php

namespace App\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait SmsTrait
{
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSms($message, $phone)
    {

        $this->account_id = (config('keys.sms.account_id'));
        $this->token = (config('keys.sms.token'));
        $this->sender = (config('keys.sms.sender'));

        

        $client = new Client($this->account_id, $this->token);
        try {
  
            
          
            $client->messages->create($phone, [
                'from' => $this->sender, 
                'body' => $message]);
  
         
  
        } catch (Exception $e) {
            \Log::info($e->getMessage());
            
        }
    }
}