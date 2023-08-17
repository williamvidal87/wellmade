<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibrationWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibration_work_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jo_no_id');
            $table->unsignedBigInteger('jo_type_id');
            $table->unsignedBigInteger('calib_work_group_id');
            $table->unsignedBigInteger('work_sub_type_id');
            $table->unsignedBigInteger('general_procedure_id');
            $table->longText('scope');
            $table->unsignedBigInteger('machine_id');
            $table->longText('remarks');
            $table->unsignedBigInteger('parts_required');
            $table->string('hours');
            $table->string('qty');
            $table->decimal('price',9, 2);
            $table->decimal('amount_increase',9 ,2);
            $table->unsignedBigInteger('discount_id');
            $table->unsignedBigInteger('incentive_type_id');
            $table->decimal('incentive',9 ,2);
            $table->unsignedBigInteger('status_id');

            $table->foreign('jo_no_id')->references('id')->on('job_orders');
            $table->foreign('jo_type_id')->references('id')->on('job_types');
            $table->foreign('calib_work_group_id')->references('id')->on('groups');
            $table->foreign('work_sub_type_id')->references('id')->on('sub_group_rates');
            $table->foreign('general_procedure_id')->references('id')->on('general_procedures');           
            $table->foreign('machine_id')->references('id')->on('machines');
            $table->foreign('parts_required')->references('id')->on('statuses');
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->foreign('incentive_type_id')->references('id')->on('incentive_types');
            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::dropIfExists('calibration_work_orders');
    }
}
