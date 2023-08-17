<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_workers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_order_id');
            $table->unsignedBigInteger('assigned_worker_id');
            $table->unsignedBigInteger('percent_id');
            $table->unsignedBigInteger('parts_percent_id');
            $table->string('allot_hours')->nullable();
            $table->string('extension')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            
            $table->foreign('work_order_id')->references('id')->on('work_orders');
            $table->foreign('assigned_worker_id')->references('id')->on('users');
            $table->foreign('percent_id')->references('id')->on('percents');
            $table->foreign('parts_percent_id')->references('id')->on('percents');
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
        Schema::dropIfExists('add_workers');
    }
}
