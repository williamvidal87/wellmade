<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReceiptColumnInTransactionSummaryTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_summaries', function (Blueprint $table) {
            $table->string('receipt')->nullable()->after('dated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_summaries', function (Blueprint $table) {
            $table->dropColumn('receipt');
        });
    }
}
