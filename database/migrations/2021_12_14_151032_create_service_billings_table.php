<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_billings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('reference_no');
            $table->unsignedBigInteger('jo_no');
            $table->string('customer_name');
            $table->string('address');
            $table->string('contact_no');
            $table->string('job_type');
            $table->text('description');
            $table->string('cash_charge');
            // $table->string('term_of_payment');
            $table->string('total_bill');
            $table->unsignedBigInteger('payment_type');
            $table->foreign('jo_no')->references('id')->on('job_orders')->onDelete('cascade');
            $table->foreign('payment_type')->references('id')->on('type_of_payments')->onDelete('cascade');
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
        Schema::dropIfExists('service_billings');
    }
}
