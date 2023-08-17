<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_management', function (Blueprint $table) {
            $table->id();
            
            $table->string('item_code');
            $table->unsignedBigInteger('supplier');
            $table->string('name');
            $table->text('description');
            $table->string('serial');
            
            $table->string('qty');
            $table->boolean('REP');
            $table->string('item_location');
        
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
        Schema::dropIfExists('stock_management');
    }
}
