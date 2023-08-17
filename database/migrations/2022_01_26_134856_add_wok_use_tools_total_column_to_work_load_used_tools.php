<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWokUseToolsTotalColumnToWorkLoadUsedTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_load_used_tools', function (Blueprint $table) {
            $table->decimal('total',9,2)->nullable()->after('gear_milling')->change();//added change
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_load_used_tools', function (Blueprint $table) {
            $table->dropColumn('total');
        });
    }
}
