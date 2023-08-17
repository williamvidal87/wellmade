<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoanConsumeStatusIdInStockManagementTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_management', function (Blueprint $table) {
            $table->unsignedBigInteger('loan_consume_status_id')->after('conversion_rate');
            $table->foreign('loan_consume_status_id')->references('id')->on('loan_consume_statuses');
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
            $table->dropForeign('stock_management_loan_consume_status_id_foreign');
            $table->dropColumn('loan_consume_status_id');
        });
    }
}
