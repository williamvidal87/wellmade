<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterReceiptDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_receipt_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cr_id')->nullable();
            $table->unsignedBigInteger('transaction_summary_cr_id')->nullable();
            $table->unsignedBigInteger('transaction_payment_cr_id')->nullable();
            $table->tinyInteger('update_counter_receipt')->default('0');
            $table->tinyInteger('counter_receipt_arrangement')->default('0');
            $table->foreign('cr_id')->references('id')->on('counter_receipts');
            $table->foreign('transaction_summary_cr_id')->references('id')->on('transaction_summaries');
            $table->foreign('transaction_payment_cr_id')->references('id')->on('transaction_summaries');
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
        Schema::dropIfExists('counter_receipt_data');
    }
}
