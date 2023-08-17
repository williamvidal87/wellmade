<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_procedures', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('work_sub_type_id');
            $table->string('general_procedure_name');
            $table->timestamps();
            $table->softDeletes();
            
            
            $table->foreign('work_sub_type_id')->references('id')->on('sub_group_rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_procedures');
    }
}
