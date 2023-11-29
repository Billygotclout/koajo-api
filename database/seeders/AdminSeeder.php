<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@koajo.co',
            'phone' => '09090909090',
            'verification_code' => 'aaa',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'), //password
            'status' => 'active',
            'role' => 'admin',
        ]);
    }
    
}
