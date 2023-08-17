<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machine_description_number_id');
            $table->string('description');
            $table->timestamps();
            
            $table->foreign('machine_description_number_id')->references('id')->on('machine_id_numbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machine_descriptions');
    }
}
