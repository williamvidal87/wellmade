<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusOnAddWorkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('add_workers', function (Blueprint $table) {
            $table->unsignedBigInteger('status')->nullable();
            $table->foreign('status')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('add_workers', function (Blueprint $table) {
            $table->unsignedBigInteger('status')->nullable();
            $table->foreign('status')->references('id')->on('statuses');
        });
    }
}
