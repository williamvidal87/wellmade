<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToScopes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scopes', function (Blueprint $table) {
            $table->string('price_a')->nullable();
            $table->string('price_b')->nullable();
            $table->string('price_c')->nullable();
            $table->string('price_d')->nullable();
            $table->string('price_e')->nullable();
            $table->string('price_f')->nullable();
            $table->string('price_g')->nullable();
            $table->string('price_h')->nullable();
            $table->string('price_i')->nullable();
            $table->string('price_j')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scopes', function (Blueprint $table) {
            //
        });
    }
}
