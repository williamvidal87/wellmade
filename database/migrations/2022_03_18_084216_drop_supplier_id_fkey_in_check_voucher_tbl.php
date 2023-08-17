<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSupplierIdFkeyInCheckVoucherTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('check_vouchers', function (Blueprint $table) {
            $table->dropForeign('check_vouchers_supplier_id_foreign');
            $table->dropColumn('supplier_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('check_vouchers', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->nullable()->after('transaction_status_id');
            $table->foreign('supplier_id')->references('id')->on('billing_suppliers');
        });
    }
}
