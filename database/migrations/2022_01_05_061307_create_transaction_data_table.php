<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_summary_id');
            $table->unsignedBigInteger('account_number');
            $table->string('account_title');
            $table->decimal('debits',9, 2);
            $table->decimal('credits',9, 2);
            $table->foreign('transaction_summary_id')->references('id')->on('transaction_summaries')->onDelete('cascade');
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
        Schema::dropIfExists('transaction_data');
    }
}
