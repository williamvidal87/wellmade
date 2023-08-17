<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckVoucherDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_voucher_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_voucher_id')->nullable();
            $table->unsignedBigInteger('account_number')->nullable();
            $table->tinyInteger('update_check_voucher')->default('0');
            $table->tinyInteger('check_voucher_arrangement')->default('0');
            $table->decimal('debits',9, 2);
            $table->decimal('credits',9, 2);
            $table->foreign('check_voucher_id')->references('id')->on('check_vouchers');
            $table->foreign('account_number')->references('id')->on('chart_of_accounts');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_voucher_data');
    }
}
