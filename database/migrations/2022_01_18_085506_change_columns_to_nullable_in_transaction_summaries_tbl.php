<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToNullableInTransactionSummariesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_summaries', function (Blueprint $table) {
            $table->unsignedBigInteger('receipt_type_id')->nullable()->change();
            $table->unsignedBigInteger('bank')->nullable()->change();
            $table->string('gl_account_bank')->nullable()->change();
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
            $table->unsignedBigInteger('receipt_type_id')->nullable(false)->change();
            $table->unsignedBigInteger('bank')->nullable(false)->change();
            $table->string('gl_account_bank')->nullable()->change();
        });
    }
}
