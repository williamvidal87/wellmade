<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyConsumeReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_consume_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_management_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('work_area_id');
            $table->unsignedBigInteger('department_id');    
            $table->integer('quantity');
            $table->decimal('total',9,2)->nullable();  
            
            $table->foreign('stock_management_id')->references('id')->on('stock_management');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('work_area_id')->references('id')->on('work_areas');
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('daily_consume_reports');
    }
}
