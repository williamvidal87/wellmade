<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('or_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_summary_id')->nullable();
            $table->foreign('transaction_summary_id')->references('id')->on('transaction_summaries');
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
        Schema::dropIfExists('or_transactions');
    }
}
