<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSbTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sb_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_summary_id')->nullable();
            $table->foreign('transaction_summary_id')->references('id')->on('transaction_summaries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sb_transactions');
    }
}
