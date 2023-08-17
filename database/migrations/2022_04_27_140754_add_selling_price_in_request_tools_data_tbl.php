<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSellingPriceInRequestToolsDataTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_tool_data', function (Blueprint $table) {
            $table->decimal('selling_price', 9, 2)->nullable()->after('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_tool_data', function (Blueprint $table) {
            $table->dropColumn('selling_price');
        });
    }
}
