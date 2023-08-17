<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_tools', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->text('request_type')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('jo_no_id')->nullable();
            $table->unsignedBigInteger('request_by_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('jo_no_id')->references('id')->on('job_orders');
            $table->foreign('request_by_id')->references('id')->on('contacts');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_tools');
    }
}
