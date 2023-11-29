<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('bank_id');
            $table->string('bank_name');
            $table->integer('bank_code');
            $table->string('account_name');
            $table->string('account_number');
            $table->enum('status',['pending','active']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payout_accounts');
    }
}
