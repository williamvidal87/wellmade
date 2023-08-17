<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_summaries', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('receipt_type_id');
            $table->unsignedBigInteger('transaction_type_id');
            $table->string('receipt_no');
            $table->unsignedBigInteger('receipt_for');
            $table->unsignedBigInteger('document_type');
            $table->unsignedBigInteger('jo_no');
            $table->string('customer_name');
            $table->unsignedBigInteger('bank');
            $table->string('gl_account_bank');
            $table->string('check_no')->nullable();
            $table->string('sb_date');
            $table->decimal('all_total_debits',9 ,2);
            $table->decimal('all_total_credits',9 ,2);
            $table->foreign('receipt_type_id')->references('id')->on('receipt_types');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('receipt_for')->references('id')->on('receipt_fors');
            $table->foreign('document_type')->references('id')->on('document_types');
            $table->foreign('bank')->references('id')->on('banks');
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
        Schema::dropIfExists('transaction_summaries');
    }
}
