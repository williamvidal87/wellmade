<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToNullableInUserTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->string('contact_no')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('emergency_contact_person')->nullable()->change();
            $table->string('emergency_contact_address')->nullable()->change();
            $table->string('emergency_contact_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable(false)->change();
            $table->string('contact_no')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('emergency_contact_person')->nullable(false)->change();
            $table->string('emergency_contact_address')->nullable(false)->change();
            $table->string('emergency_contact_no')->nullable(false)->change();
        });
    }
}
