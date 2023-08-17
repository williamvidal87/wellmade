<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machine_group_category_id');
            $table->unsignedBigInteger('machine_group_number_id')->nullable();
            $table->string('machine_group_name');
            $table->timestamps();
            
            $table->foreign('machine_group_category_id')->references('id')->on('machine_categories');
            $table->foreign('machine_group_number_id')->references('id')->on('machine_id_numbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machine_groups');
    }
}
