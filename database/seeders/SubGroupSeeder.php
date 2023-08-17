<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubGroup;

class SubGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
			[

                'job_type_id'           =>  1,
				'group_name' 			=> 'Machining & fabrication',
			],
			[
			    'job_type_id'           =>  1,
				'group_name' 		    => 'Repair & Installation',
			],
			[
			    'job_type_id'           =>  2,
                'group_name'            => 'CrankShaft',
            ],
            [
                'job_type_id'           =>  2,
                'group_name'            => 'Cylinder Blocks',
            ],
            [
                'job_type_id'           =>  2,
                'group_name'            => 'Conrod Arm',
            ],
            [
                'job_type_id'           =>  2,
                'group_name'            => 'Cylinder Head Assymble',
            ],
            [
                'job_type_id'           =>  2,
                'group_name'            => 'Miscelaneous',
            ],
            [
                'job_type_id'           =>  3,
                'group_name'            => 'LABOR',
            ],
            [
                'job_type_id'           =>  3,
                'group_name'            => 'PARTS',
            ],
            
        ];
        
        foreach ($groups as $key => $value) {

            SubGroup::insert([
                'job_type_id' => $value['job_type_id'],
                'group_name' => $value['group_name'],
            ]);
		}
    }
}
