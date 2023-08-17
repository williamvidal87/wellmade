<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no');
            $table->date('date');
            $table->string('jo_no');
            $table->unsignedBigInteger('customer_id');
            $table->bigInteger('po_no');
            $table->date('po_date');
            $table->unsignedBigInteger('csa');
            $table->unsignedBigInteger('credited_to');
            $table->unsignedBigInteger('engine_model');
            $table->unsignedBigInteger('makelist_id');
            $table->unsignedBigInteger('category');
            $table->string('serial_no');
            $table->date('date_receive');
            $table->date('date_commited');
            $table->unsignedBigInteger('terms_of_payment');
            $table->text('remarks')->nullable();
            $table->string('edit_reason')->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->unsignedBigInteger('payment_status_id')->nullable();
            $table->string('item_image')->nullable();
            $table->dateTime('work_date_start')->nullable();
            $table->dateTime('work_date_end')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('client_profiles');
            $table->foreign('csa')->references('id')->on('csa_types');
            $table->foreign('credited_to')->references('id')->on('users');
            $table->foreign('engine_model')->references('id')->on('engine_models');
            $table->foreign('makelist_id')->references('id')->on('make_lists');
            $table->foreign('category')->references('id')->on('category_lists');
            $table->foreign('terms_of_payment')->references('id')->on('type_of_payments');
            $table->foreign('status')->references('id')->on('statuses');
            $table->foreign('payment_status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_orders');
    }
}
