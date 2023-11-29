<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->double('ajo_amount', 8, 2);
            $table->integer('number_of_people');
            $table->enum('payment_schedule', ['weekly', 'monthly']);
            $table->enum('type', ['public', 'private']);
            $table->enum('status', ['pending', 'active', 'completed'])->default('pending');
            $table->string('code')->nullable();

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
        Schema::dropIfExists('ajos');
    }
}
