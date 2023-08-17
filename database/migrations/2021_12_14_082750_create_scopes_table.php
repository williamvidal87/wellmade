<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScopesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scopes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('er_work_group_id');
            $table->string('scope_name');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->time('min_work_mins')->nullable();
            $table->time('max_work_mins')->nullable();
            $table->smallInteger('allow_simulationeos_work')->nullable();
            $table->smallInteger('parts_required')->nullable();
            $table->foreign('er_work_group_id')->references('id')->on('groups');
            $table->foreign('unit_id')->references('id')->on('er_units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scopes');
    }
}
