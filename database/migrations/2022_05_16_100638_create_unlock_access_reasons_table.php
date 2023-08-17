<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnlockAccessReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unlock_access_reasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jo_no_id');
            $table->text('reasons');
            $table->unsignedBigInteger('user_id');
            $table->foreign('jo_no_id')->references('id')->on('job_orders');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('unlock_access_reasons');
    }
}
