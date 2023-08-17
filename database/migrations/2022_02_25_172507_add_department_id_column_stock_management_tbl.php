<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentIdColumnStockManagementTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_management', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('loan_consume_status_id');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_management', function (Blueprint $table) {
            $table->dropForeign('stock_management_department_id_foreign');
            $table->dropColumn('department_id');
        });
    }
}
