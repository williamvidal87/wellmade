<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequestByIdInRequestTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_tools', function (Blueprint $table) {
            $table->unsignedBigInteger('request_by_id')->nullable();
            $table->foreign('request_by_id')->references('id')->on('users');
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
            $table->dropForeign('request_tools_request_by_id_foreign');
            $table->dropColumn('request_by_id');
        });
    }
}
