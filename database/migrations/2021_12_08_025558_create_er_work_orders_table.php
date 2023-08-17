<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('er_work_orders', function (Blueprint $table) {
            $table->id();
             // $table->unsignedBigInteger('jo_no_id');
            // $table->unsignedBigInteger('job_type_id');
            $table->unsignedBigInteger('er_work_group_id');          
            $table->unsignedBigInteger('scope_of_work_id');
            $table->unsignedBigInteger('specification_id');
            $table->string('general_procedure');
            $table->unsignedBigInteger('work_sub_type_id');
            $table->unsignedBigInteger('machine_id');
            $table->longText('description');
            $table->longText('remarks');
            $table->unsignedBigInteger('parts_required_id'); 
            $table->string('hours');
            $table->string('qty');
            $table->decimal('price',9 ,2);
            $table->decimal('amount_increase',9 ,2);
            $table->unsignedBigInteger('discount_id');
            $table->decimal('max_discount',9 ,2);
            $table->unsignedBigInteger('incentive_type_id');
            $table->string('incentive');
            
            // $table->foreign('jo_no_id')->references('id')->on('job_orders');
            // $table->foreign('job_type_id')->references('id')->on('job_types');
            $table->foreign('er_work_group_id')->references('id')->on('groups');
            $table->foreign('scope_of_work_id')->references('id')->on('scope_work_groups');
            $table->foreign('specification_id')->references('id')->on('specifications');
            // $table->foreign('general_procedure_id')->references('id')->on('general_procedures');
            $table->foreign('work_sub_type_id')->references('id')->on('groups');           
            $table->foreign('machine_id')->references('id')->on('machines');
            $table->foreign('parts_required_id')->references('id')->on('statuses');
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->foreign('incentive_type_id')->references('id')->on('incentive_types');
            

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
        Schema::dropIfExists('er_work_orders');
    }
}
