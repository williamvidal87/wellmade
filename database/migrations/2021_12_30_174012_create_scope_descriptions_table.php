<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScopeDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scope_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_type_id');
            $table->string('scope_description_name');
            $table->softDeletes();
            // $table->timestamps();
            
            
            $table->foreign('sub_type_id')->references('id')->on('sub_group_rates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scope_descriptions');
    }
}
