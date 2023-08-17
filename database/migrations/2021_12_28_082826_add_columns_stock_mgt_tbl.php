<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsStockMgtTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_management', function (Blueprint $table) {
            $table->unsignedBigInteger('inventory_type_id')->after('id');
            $table->foreign('inventory_type_id')->references('id')->on('inventory_types');
            $table->unsignedBigInteger('unit_type_id')->after('inventory_type_id');
            $table->foreign('unit_type_id')->references('id')->on('unit_types');
            $table->string('brand')->after('unit_type_id');
            $table->string('barcode')->after('brand');
            $table->decimal('unit_price', 9, 2)->after('serial');
            $table->decimal('price_adjustment', 9, 2)->after('unit_price');
            $table->string('item_image')->nullable()->after('item_location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_management', function (Blueprint $table) {
            //
        });
    }
}
