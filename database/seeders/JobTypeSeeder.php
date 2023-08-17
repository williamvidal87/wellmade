<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobTypes;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobtypes = [
			[

				'abbriv_code' 			=> 'MF',
                'description' 			=> 'Machining and Fabrication',
			],
            [

				'abbriv_code' 			=> 'ER',
                'description' 			=> 'Engine Reconditiong',
			],
            [

				'abbriv_code' 			=> 'Calib',
                'description' 			=> 'Calibration',
			],
            
        ];
        
        foreach ($jobtypes as $key => $value) {
            JobTypes::insert([
                'abbriv_code' => $value['abbriv_code'],
                'description' => $value['description'],
            ]);
		}
    }
}
