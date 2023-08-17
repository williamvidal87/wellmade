<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInTransactionSummaryTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_summaries', function (Blueprint $table) {
            $table->unsignedBigInteger('collected_by_id')->nullable()->after('all_total_credits');
            $table->unsignedBigInteger('payment_type_id')->nullable()->after('collected_by_id');
            $table->unsignedBigInteger('customer_bank_id')->nullable()->after('payment_type_id');
            $table->date('dated')->nullable()->after('customer_bank_id');
            $table->string('cheque_no')->nullable()->after('dated');
            $table->foreign('collected_by_id')->references('id')->on('collects');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('customer_bank_id')->references('id')->on('banks');
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
            $table->dropForeign('transaction_summaries_collected_by_id_foreign');
            $table->dropForeign('transaction_summaries_payment_type_id_foreign');
            $table->dropForeign('transaction_summaries_customer_bank_id_foreign');
            $table->dropColumn('dated');
            $table->dropColumn('collected_by_id');
            $table->dropColumn('payment_type_id');
            $table->dropColumn('customer_bank_id');
            $table->dropColumn('cheque_no');
        });
    }
}
