<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusIdInCounterReceiptDataTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counter_receipt_data', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->after('counter_receipt_arrangement');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counter_receipt_data', function (Blueprint $table) {
            $table->dropForeign('counter_receipt_data_status_id_foreign');
            $table->dropColumn('status_id');
        });
    }
}
