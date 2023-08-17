<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInJobOrderTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_orders', function (Blueprint $table) {
            $table->integer('term')->nullable()->after('work_date_end');
            $table->integer('discount')->nullable()->after('term');
            $table->decimal('er_total',9 ,2)->nullable()->after('discount');
            $table->decimal('mf_total',9 ,2)->nullable()->after('er_total');
            $table->decimal('calib_total',9 ,2)->nullable()->after('mf_total');
            $table->decimal('overall_total',9 ,2)->nullable()->after('calib_total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_orders', function (Blueprint $table) {
            //
        });
    }
}
