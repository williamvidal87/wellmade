<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcessGroupIdProcessSubGroupsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process_sub_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('process_group_id')->after('id')->nullable();
            $table->foreign('process_group_id')->references('id')->on('process_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process_sub_groups', function (Blueprint $table) {
            $table->dropForeign('process_sub_groups_process_group_id_foreign');
            $table->dropColumn('process_group_id');
        });
    }
}
