<?php

use App\Models\Ajo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjoGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajo_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_id');
            $table->string('creator_user_id');
            $table->string('creator_firstname');
            $table->json('members_id');
            $table->json('members_order_no');
            $table->double('amount', 8, 2);
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
        Schema::dropIfExists('ajo_groups');
    }
}
