<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurementItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pr_id');
            $table->unsignedBigInteger('stock_id');
            $table->string('qty');
            $table->text('unit');
            $table->decimal('price', 9, 2);
            $table->decimal('total_price', 9, 2);
            $table->foreign('pr_id')->references('id')->on('purchase_orders');
            $table->foreign('stock_id')->references('id')->on('stock_management');
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
        Schema::dropIfExists('procurement_items');
    }
}
