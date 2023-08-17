<?php

namespace Database\Seeders;

use App\Models\CalibWorkGroup;
use Illuminate\Database\Seeder;

class CalibWorkGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $calibworkgroup = [
			[

				'calib_work_group_name' => 'LABOR',
			],
            [

				'calib_work_group_name' => 'PARTS',
			],
            
        ];
        
        foreach ($calibworkgroup as $key => $value) {
            CalibWorkGroup::insert([
                'calib_work_group_name' => $value['calib_work_group_name'],
            ]);
		}
    }
}
