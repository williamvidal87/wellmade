<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScopesDescriptionIdToWorkOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('scope_description_id')->nullable()->after('calib_work_sub_type_id');
            $table->foreign('scope_description_id')->references('id')->on('scope_descriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropForeign('work_orders_scope_description_id_foreign');
            $table->dropColumn('scope_description_id');
        });
    }
}
