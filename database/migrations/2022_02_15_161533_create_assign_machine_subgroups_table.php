<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignMachineSubgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_machine_subgroups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machine_sub_group_number_id');
            $table->unsignedBigInteger('machine_group_id');
            $table->unsignedBigInteger('machine_sub_group_id')->nullable();
            $table->timestamps();
            
            $table->foreign('machine_sub_group_number_id')->references('id')->on('machine_id_numbers');
            $table->foreign('machine_group_id')->references('id')->on('machine_groups');
            $table->foreign('machine_sub_group_id')->references('id')->on('machine_sub_group_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_machine_subgroups');
    }
}