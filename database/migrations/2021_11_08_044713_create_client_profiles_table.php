<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('client_type');
            $table->unsignedBigInteger('csa_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('address');
            $table->bigInteger('contact_no');
            $table->string('contact_person');
            $table->foreign('client_type')->references('id')->on('client_types')->onDelete('cascade');
            $table->foreign('csa_id')->references('id')->on('csa_types')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
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
        Schema::dropIfExists('client_profiles');
    }
}
