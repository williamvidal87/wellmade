<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_vouchers', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('voucher_type_id')->nullable();
            $table->unsignedBigInteger('for_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('transaction_status_id')->nullable();
            $table->decimal('amount', 9, 2)->nullable();
            $table->string('check_no')->nullable();
            $table->date('check_date')->nullable();
            $table->text('summary_explanation')->nullable();
            $table->text('particulars')->nullable();
            $table->foreign('voucher_type_id')->references('id')->on('voucher_types');
            $table->foreign('for_id')->references('id')->on('transaction_fors');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('transaction_status_id')->references('id')->on('transaction_statuses');
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_vouchers');
    }
}
