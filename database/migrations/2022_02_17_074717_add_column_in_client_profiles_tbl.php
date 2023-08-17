<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInClientProfilesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_issued_id')->nullable()->after('contact_person');
            $table->unsignedBigInteger('discount_er')->nullable()->after('invoice_issued_id');
            $table->unsignedBigInteger('discount_mf')->nullable()->after('discount_er');
            $table->unsignedBigInteger('discount_spareparts')->nullable()->after('discount_mf');
            $table->unsignedBigInteger('discount_calib')->nullable()->after('discount_spareparts');
            $table->unsignedBigInteger('payment_type_id')->nullable()->after('discount_calib');
            $table->foreign('invoice_issued_id')->references('id')->on('invoice_issueds');
            $table->foreign('discount_er')->references('id')->on('discount_percentages');
            $table->foreign('discount_mf')->references('id')->on('discount_percentages');
            $table->foreign('discount_spareparts')->references('id')->on('discount_percentages');
            $table->foreign('discount_calib')->references('id')->on('discount_percentages');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_profiles', function (Blueprint $table) {
            //
        });
    }
}
