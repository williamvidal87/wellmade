<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePriceAdjustmentBarcodeItemLocationStockManagementTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_management', function (Blueprint $table) {
            $table->dropColumn('price_adjustment');
            $table->dropColumn('barcode');
            $table->dropColumn('item_location');
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
            $table->decimal('price_adjustment', 9, 2)->after('unit_price');
            $table->string('barcode')->after('brand');
            $table->string('item_location');
        });
    }
}
