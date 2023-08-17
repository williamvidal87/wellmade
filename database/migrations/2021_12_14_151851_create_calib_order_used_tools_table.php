<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibOrderUsedToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calib_order_used_tools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calib_work_order_id');
            $table->unsignedBigInteger('item_name');
            $table->integer('quantity');

            $table->foreign('calib_work_order_id')->references('id')->on('calibration_work_orders');
            $table->foreign('item_name')->references('id')->on('stock_management');
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
        Schema::dropIfExists('calib_order_used_tools');
    }
}
