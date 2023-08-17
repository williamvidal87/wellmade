<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductArrangementColumnInProcurementItemsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('procurement_items', function (Blueprint $table) {
            $table->tinyInteger('product_arrangement')->after('update_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procurement_items', function (Blueprint $table) {
            $table->dropColumn('product_arrangement');
        });
    }
}
