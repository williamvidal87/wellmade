<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableModelMakeCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('engine_model')->nullable()->change();
            $table->unsignedBigInteger('makelist_id')->nullable()->change();
            $table->unsignedBigInteger('category')->nullable()->change();
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
            $table->unsignedBigInteger('engine_model')->nullable()->change();
            $table->unsignedBigInteger('makelist_id')->nullable()->change();
            $table->unsignedBigInteger('category')->nullable()->change();
        });
    }
}
