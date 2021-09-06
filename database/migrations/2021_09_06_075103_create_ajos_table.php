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
            $table->double('amount', 8, 2)->default(0.00);
            $table->enum('status', ['pending', 'joined', 'cancelled']);
            $table->enum('duration', ['4 months']);
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
