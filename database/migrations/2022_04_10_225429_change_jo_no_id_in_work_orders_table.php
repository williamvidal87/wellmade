<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJoNoIdInWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
    //
        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropForeign(['jo_no_id']);
            $table->dropForeign(['work_order_start_id']);
            $table->dropForeign(['work_order_end_id']);
            $table->foreign('jo_no_id')->references('id')->on('job_orders')->onDelete('cascade');
            $table->foreign('work_order_start_id')->references('id')->on('add_workers')->onDelete('cascade');
            $table->foreign('work_order_end_id')->references('id')->on('add_workers')->onDelete('cascade');
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
        });
    }
}
