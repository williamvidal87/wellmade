<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionStatusIdInCounterReceiptsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counter_receipts', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_status_id')->nullable()->after('paid');
            $table->foreign('transaction_status_id')->references('id')->on('transaction_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counter_receipts', function (Blueprint $table) {
            $table->dropForeign('counter_receipts_transaction_status_id_foreign');
            $table->dropColumn('transaction_status_id');
        });
    }
}
