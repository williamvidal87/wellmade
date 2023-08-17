<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionArrangementColumnInTransactionDataTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_data', function (Blueprint $table) {
            $table->tinyInteger('transaction_arrangement')->after('update_transaction')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_data', function (Blueprint $table) {
            $table->dropColumn('transaction_arrangement');
        });
    }
}
