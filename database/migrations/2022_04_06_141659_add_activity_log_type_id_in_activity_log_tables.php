<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivityLogTypeIdInActivityLogTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_log_tables', function (Blueprint $table) {
            $table->unsignedBigInteger('activity_log_type_id')->nullable()->after('subject_id');
            $table->foreign('activity_log_type_id')->references('id')->on('activity_log_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_log_tables', function (Blueprint $table) {
            $table->dropForeign('activity_log_tables_activity_log_type_id_foreign');
            $table->dropColumn('activity_log_type_id');
        });
    }
}
