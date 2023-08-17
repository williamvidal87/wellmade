<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToActivityLogTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_log_tables', function (Blueprint $table) {

            $table->unsignedBigInteger('subject_id')->change();
            $table->foreign('subject_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->unsignedBigInteger('subject_id')->change();
            $table->foreign('subject_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
