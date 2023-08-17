<?php

namespace Database\Seeders;

use App\Models\WorkSubType;
use Illuminate\Database\Seeder;

class WorkSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $worksubtype= [
            
			[
                'job_type_id'           => 1,
				'work_sub_type_name'    => 'Lathe',
			],
			[
                'job_type_id'           => 1,
				'work_sub_type_name'    => 'Weld',
			],
			[
                'job_type_id'           => 1,
				'work_sub_type_name'    => 'Mill',
			],
			[
                'job_type_id'           => 1,
				'work_sub_type_name'    => 'Shaper',
			],
			[
                'job_type_id'           => 1,
				'work_sub_type_name'    => 'Bal',
			],
			[
                'job_type_id'           => 1,
				'work_sub_type_name'    => 'Labor',
			],
			[
                'job_type_id'           => 1,
				'work_sub_type_name'    => 'BMill',
			],
			[
                'job_type_id'           => 1,
				'work_sub_type_name'    => 'Bore',
			],
			[
                'job_type_id'           => 1,
				'work_sub_type_name'    => 'KMill',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'CShaft',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'Surface',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'Valve',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'Liners',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'MHouse',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'Conrod',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'Vseat',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'Lathe',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'Tig',
			],
			[
                'job_type_id'           => 2,
				'work_sub_type_name'    => 'Labor',
			],
			[
                'job_type_id'           => 3,
				'work_sub_type_name'    => 'Inject',
			],
			[
                'job_type_id'           => 3,
				'work_sub_type_name'    => 'Pump',
			],
            
            
        ];
        
        foreach ($worksubtype as $key => $value) {
            WorkSubType::insert([
                'job_type_id'        => $value['job_type_id'],
                'work_sub_type_name' => $value['work_sub_type_name'],
            ]);
		}
    }
}
