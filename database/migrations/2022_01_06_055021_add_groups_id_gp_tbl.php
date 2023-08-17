<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupsIdGpTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_procedures', function (Blueprint $table) {
            $table->unsignedBigInteger('groups_id')->nullable()->after('id');
            $table->foreign('groups_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_procedures', function (Blueprint $table) {
            $table->dropForeign('general_procedures_groups_id_foreign');
            $table->dropColumn('groups_id');
        });
    }
}
