<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdateTransactionColumnInTransactionDataTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_data', function (Blueprint $table) {
            $table->tinyInteger('update_transaction')->after('account_title')->default('0');
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
            $table->dropColumn('update_transaction');
        });
    }
}
