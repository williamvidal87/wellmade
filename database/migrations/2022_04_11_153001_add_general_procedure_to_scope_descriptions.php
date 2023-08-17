<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGeneralProcedureToScopeDescriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scope_descriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('general_procedure_id')->nullable();
            $table->foreign('general_procedure_id')->references('id')->on('general_procedures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scope_descriptions', function (Blueprint $table) {
            //
        });
    }
}
