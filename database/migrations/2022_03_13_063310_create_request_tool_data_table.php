<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestToolDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_tool_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_tool_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('qty');
            $table->tinyInteger('update_request_tool_data')->default('0');
            $table->tinyInteger('request_tool_arrangement')->default('0');
            $table->foreign('request_tool_id')->references('id')->on('request_tools');
            $table->foreign('item_id')->references('id')->on('stock_management');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_tool_data');
    }
}
