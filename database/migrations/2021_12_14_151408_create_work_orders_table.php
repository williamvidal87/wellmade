<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_type_id');
            $table->unsignedBigInteger('jo_no_id')->nullable();
            $table->string('reference_no_id')->nullable();
            // for mf
            $table->unsignedBigInteger('mf_work_group_id')->nullable();
            $table->unsignedBigInteger('mf_work_sub_type_id')->nullable();
            // for er
            $table->unsignedBigInteger('er_work_group_id')->nullable();
            $table->unsignedBigInteger('scopes_id')->nullable();
            $table->unsignedBigInteger('er_work_sub_type_id')->nullable();
            // for calib
            $table->unsignedBigInteger('calib_work_group_id')->nullable();
            $table->unsignedBigInteger('calib_work_sub_type_id')->nullable();
            // $table->unsignedBigInteger('scope_description_id')->nullable(); 
            
            // for all
            $table->unsignedBigInteger('specification_id')->nullable();
            $table->string('general_procedure')->nullable();
            $table->string('scope_description')->nullable();
            $table->unsignedBigInteger('general_procedure_id')->nullable();
            $table->unsignedBigInteger('process_group_id')->nullable();
            $table->unsignedBigInteger('process_subgroup_id')->nullable();
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('suggested_cost',9 ,2)->nullable();
            $table->decimal('process_cost',9 ,2)->nullable();
            $table->longText('remarks')->nullable();
            $table->unsignedBigInteger('parts_required_id')->nullable();  
            $table->string('hours')->nullable();
            $table->string('qty')->nullable();
            $table->decimal('price',9 ,2)->nullable();
            $table->decimal('amount_increase',9 ,2)->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->decimal('max_discount',9 ,2)->nullable();
            $table->unsignedBigInteger('incentive_type_id')->nullable();
            $table->string('incentive')->nullable();
            $table->unsignedBigInteger('status')->nullable();



            $table->foreign('job_type_id')->references('id')->on('job_types');
            $table->foreign('jo_no_id')->references('id')->on('job_orders');
            
            $table->foreign('mf_work_group_id')->references('id')->on('groups');
            $table->foreign('mf_work_sub_type_id')->references('id')->on('work_sub_types');
            
            $table->foreign('er_work_group_id')->references('id')->on('groups');
            $table->foreign('scopes_id')->references('id')->on('scopes');
            $table->foreign('er_work_sub_type_id')->references('id')->on('sub_group_rates');
            
            $table->foreign('calib_work_group_id')->references('id')->on('groups');
            $table->foreign('calib_work_sub_type_id')->references('id')->on('sub_group_rates');
            // $table->foreign('scope_description_id')->references('id')->on('scope_descriptions');
            
            
            $table->foreign('specification_id')->references('id')->on('specifications');
            $table->foreign('general_procedure_id')->references('id')->on('general_procedures');
            $table->foreign('process_group_id')->references('id')->on('process_groups');
            $table->foreign('process_subgroup_id')->references('id')->on('process_sub_groups');
            $table->foreign('machine_id')->references('id')->on('machines');
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->foreign('incentive_type_id')->references('id')->on('incentive_types');
            $table->foreign('parts_required_id')->references('id')->on('statuses');
            $table->foreign('status')->references('id')->on('statuses');
            

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
        Schema::dropIfExists('work_orders');
    }
}
