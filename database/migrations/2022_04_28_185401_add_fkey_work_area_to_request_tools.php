<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkeyWorkAreaToRequestTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_tools', function (Blueprint $table) {
            $table->unsignedBigInteger('work_area_id')->nullable()->after('status_id');
            $table->foreign('work_area_id')->references('id')->on('work_areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_tools', function (Blueprint $table) {
            //
        });
    }
}
