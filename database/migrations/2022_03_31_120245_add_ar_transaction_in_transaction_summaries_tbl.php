<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArTransactionInTransactionSummariesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_summaries', function (Blueprint $table) {
            $table->string('ar_transaction')->nullable()->after('sb_date');
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
            $table->dropColumn('ar_transaction');
        });
    }
}
