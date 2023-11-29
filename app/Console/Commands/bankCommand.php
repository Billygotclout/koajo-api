<?php

namespace App\Console\Commands;

use App\Models\Bank;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class bankCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bankCommand:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add banks to the Bank table; these banks are gotten from flutterwave';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $this->url = (config('keys.flutterwave.base_url')) . "/banks/NG";
        $this->secretKey = (config('keys.flutterwave.secret_key'));


        $banks = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->secretKey}",
        ])->get($this->url)->json();

        foreach ($banks['data'] as $bank) {

            Bank::updateOrCreate(
                ['bank_name' =>  $bank['name']],
                ['bank_code' => $bank['code']]
            );

        }

        if($banks){
            dump('i have seed banks');
        }
    }
}
