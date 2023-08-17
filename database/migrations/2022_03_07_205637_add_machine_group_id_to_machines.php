<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMachineGroupIdToMachines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machines', function (Blueprint $table) {
            // $table->dropForeign('machines_job_type_id_foreign');
            // $table->dropColumn('job_type_id');
            $table->string('machine_name')->nullable()->change();
            $table->unsignedBigInteger('machine_description_id')->nullable();
            $table->unsignedBigInteger('machine_group_id')->nullable();
            $table->unsignedBigInteger('machine_sub_group_id')->nullable();
            $table->string('serial')->nullable();
            $table->unsignedBigInteger('machine_brand_id')->nullable();
            $table->unsignedBigInteger('machine_model_id')->nullable();
            $table->unsignedBigInteger('machine_plant_assigned_id')->nullable();
            $table->unsignedBigInteger('machine_dept_location_id')->nullable();
            $table->unsignedBigInteger('machine_cost_center_id')->nullable();
            $table->unsignedBigInteger('machine_status_id')->nullable();
            $table->string('item_image')->nullable();
            $table->unsignedBigInteger('machine_purchase_from_id')->nullable();
            $table->unsignedBigInteger('machine_purchase_type_id')->nullable();
            $table->unsignedBigInteger('machine_year_made_id')->nullable();
            $table->unsignedBigInteger('machine_country_made_id')->nullable();
            $table->date('arrival_date')->nullable();
            $table->unsignedBigInteger('machine_condition_aquired_id')->nullable();
            $table->unsignedBigInteger('machine_depreciation_id')->nullable();
            $table->string('capacity')->nullable();
            $table->unsignedBigInteger('machine_unit_id')->nullable();
            $table->string('total_motor')->nullable();
            $table->string('landed_cost')->nullable();
            $table->string('rehab_cost')->nullable();
            
            $table->foreign('machine_description_id')->references('id')->on('machine_descriptions');
            $table->foreign('machine_group_id')->references('id')->on('machine_groups');
            $table->foreign('machine_sub_group_id')->references('id')->on('assign_machine_subgroups');
            $table->foreign('machine_brand_id')->references('id')->on('machine_brand_names');
            $table->foreign('machine_model_id')->references('id')->on('machine_model_names');
            $table->foreign('machine_plant_assigned_id')->references('id')->on('machine_plant_assigneds');
            $table->foreign('machine_dept_location_id')->references('id')->on('machine_dept_locations');
            $table->foreign('machine_cost_center_id')->references('id')->on('machine_cost_centers');
            $table->foreign('machine_status_id')->references('id')->on('machine_statuses');
            $table->foreign('machine_purchase_from_id')->references('id')->on('machine_purchase_froms');
            $table->foreign('machine_purchase_type_id')->references('id')->on('machine_purchase_types');
            $table->foreign('machine_year_made_id')->references('id')->on('year_mades');
            $table->foreign('machine_country_made_id')->references('id')->on('machine_country_mades');
            $table->foreign('machine_condition_aquired_id')->references('id')->on('machine_condition_aquireds');
            $table->foreign('machine_depreciation_id')->references('id')->on('machine_depreciations');
            $table->foreign('machine_unit_id')->references('id')->on('machine_units');
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
        Schema::table('machines', function (Blueprint $table) {
            //
        });
    }
}
