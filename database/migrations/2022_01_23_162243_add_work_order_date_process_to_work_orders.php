<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkOrderDateProcessToWorkOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('work_order_start_id')->nullable()->after('status');
            $table->unsignedBigInteger('work_order_end_id')->nullable()->after('work_order_start_id');
            
            $table->foreign('work_order_start_id')->references('id')->on('add_workers');
            $table->foreign('work_order_end_id')->references('id')->on('add_workers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropForeign('work_orders_work_order_start_id_foreign');
            $table->dropForeign('work_orders_work_order_end_id_foreign');
            
            $table->dropColumn('work_order_start_id');
            $table->dropColumn('work_order_end_id');
        });
    }
}
