<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrTransactionInTransactionSummariesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_summaries', function (Blueprint $table) {
            $table->string('or_transaction')->nullable()->after('ar_transaction');
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
            $table->dropColumn('or_transaction');
        });
    }
}
