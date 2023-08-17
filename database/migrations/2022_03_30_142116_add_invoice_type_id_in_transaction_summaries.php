<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceTypeIdInTransactionSummaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_summaries', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_type_id')->nullable()->after('customer_bank_id');
            $table->foreign('invoice_type_id')->references('id')->on('invoice_types');
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
            $table->dropForeign('transaction_summaries_invoice_type_id_foreign');
            $table->dropColumn('invoice_type_id');
        });
    }
}
