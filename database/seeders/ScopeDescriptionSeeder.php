<?php

namespace Database\Seeders;

use App\Models\ScopeDescription;
use Illuminate\Database\Seeder;

class ScopeDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scopedescriptions = [
			[
                'sub_type_id'                       =>  26,
				'scope_description_name' 			=> 'Disassemble',
			],
			[   
			    'sub_type_id'                       =>  26,
				'scope_description_name' 			=> 'Washing',
			],
            [   
                'sub_type_id'                       =>  26,
				'scope_description_name' 			=> 'Assemble',
			],
            [   
                'sub_type_id'                       =>  26,
				'scope_description_name' 			=> 'Calibrate and reading',
			],
            [   
                'sub_type_id'                       =>  27,
				'scope_description_name' 			=> 'Disassemble with washing',
			],
            [   
                'sub_type_id'                       =>  27,
				'scope_description_name' 			=> 'Calibrating and reading',
			]
        ];
        
        foreach ($scopedescriptions as $key => $value) {

            ScopeDescription::insert([
                'sub_type_id' => $value['sub_type_id'],
                'scope_description_name' => $value['scope_description_name'],
            ]);
		}

    }
}
