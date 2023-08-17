<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionParticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_particulars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_summary_invoice_id')->nullable();
            $table->unsignedBigInteger('transaction_summary_receipt_id')->nullable();
            $table->decimal('total_paid', 9, 2)->nullable();
            $table->decimal('this_payment', 9 ,2)->nullable();
            $table->foreign('transaction_summary_invoice_id')->references('id')->on('transaction_summaries');
            $table->foreign('transaction_summary_receipt_id')->references('id')->on('transaction_summaries');
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
        Schema::dropIfExists('transaction_particulars');
    }
}
