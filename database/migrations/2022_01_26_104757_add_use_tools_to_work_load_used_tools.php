<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUseToolsToWorkLoadUsedTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_load_used_tools', function (Blueprint $table) {
            $table->decimal('on_site',9,2)->nullable()->after('quantity');
            $table->decimal('bench_work',9,2)->nullable()->after('on_site');
            $table->decimal('boring',9,2)->nullable()->after('bench_work');
            $table->decimal('calibration',9,2)->nullable()->after('boring');
            $table->decimal('conrod_resizing',9,2)->nullable()->after('calibration');
            $table->decimal('grinding',9,2)->nullable()->after('conrod_resizing');
            $table->decimal('honing',9,2)->nullable()->after('grinding');
            $table->decimal('lathe_works',9,2)->nullable()->after('honing');
            $table->decimal('line_boring',9,2)->nullable()->after('lathe_works');
            $table->decimal('surfacing',9,2)->nullable()->after('line_boring');
            $table->decimal('tig_welding',9,2)->nullable()->after('surfacing');
            $table->decimal('valve_seat_refacing',9,2)->nullable()->after('tig_welding');
            $table->decimal('washing',9,2)->nullable()->after('valve_seat_refacing');
            $table->decimal('welding_smaw',9,2)->nullable()->after('washing');
            $table->decimal('gear_milling',9,2)->nullable()->after('welding_smaw');
            $table->decimal('total',9,2)->nullable()->after('gear_milling');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_load_used_tools', function (Blueprint $table) {
            $table->dropColumn('on_site');
            $table->dropColumn('bench_work');
            $table->dropColumn('boring');
            $table->dropColumn('calibration');
            $table->dropColumn('conrod_resizing');
            $table->dropColumn('grinding');
            $table->dropColumn('honing');
            $table->dropColumn('lathe_works');
            $table->dropColumn('line_boring');
            $table->dropColumn('surfacing');
            $table->dropColumn('tig_welding');
            $table->dropColumn('valve_seat_refacing');
            $table->dropColumn('washing');
            $table->dropColumn('welding_smaw');
            $table->dropColumn('gear_milling');
            $table->dropColumn('total');
        });
    }
}
