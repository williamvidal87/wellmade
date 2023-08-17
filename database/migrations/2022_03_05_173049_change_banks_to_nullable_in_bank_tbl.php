<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBanksToNullableInBankTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->string('abbrv_bank')->nullable()->change();
            $table->string('bank_name')->nullable()->change();
            $table->unsignedBigInteger('gl_account_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->string('abbrv_bank')->nullable(false)->change();
            $table->string('bank_name')->nullable(false)->change();
            $table->unsignedBigInteger('gl_account_id')->nullable(false)->change();
        });
    }
}
