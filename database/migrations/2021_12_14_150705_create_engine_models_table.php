<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_models', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->unsignedBigInteger('year_made_id')->nullable();
            $table->unsignedBigInteger('make_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('cylinder_id');
            $table->unsignedBigInteger('valve_id');
            // $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('year_made_id')->references('id')->on('year_mades');
            $table->foreign('make_id')->references('id')->on('make_lists');
            $table->foreign('category_id')->references('id')->on('category_lists');
            $table->foreign('cylinder_id')->references('id')->on('cylinder_lists');
            $table->foreign('valve_id')->references('id')->on('valves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engine_models');
    }
}
