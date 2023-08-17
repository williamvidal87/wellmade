<?php

namespace Database\Seeders;

use App\Models\ProcessSubGroup;
use Illuminate\Database\Seeder;

class ProcessSubGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $processsubgroups = [
			[   
                'process_group_id' 			        => 1,
				'process_sub_group_name' 			=> 'labor',
			],
			[   
                'process_group_id' 			        => 2,
				'process_sub_group_name' 			=> 'Cleaning and Measurement',
			],
			[   
                'process_group_id' 			        => 3,
				'process_sub_group_name' 			=> 'Power Hacksaw',
			],
			[   
                'process_group_id' 			        => 3,
				'process_sub_group_name' 			=> 'Bandsaw',
			],
			[   
                'process_group_id' 			        => 3,
				'process_sub_group_name' 			=> 'Cut Off Grinder',
			],
			[   
                'process_group_id' 			        => 3,
				'process_sub_group_name' 			=> 'Lathe - small',
			],
			[   
                'process_group_id' 			        => 3,
				'process_sub_group_name' 			=> 'Oxy - LPG',
			],
			[   
                'process_group_id' 			        => 3,
				'process_sub_group_name' 			=> 'Smaw',
			],
			[   
                'process_group_id' 			        => 4,
				'process_sub_group_name' 			=> 'Oxy - acetylene',
			],
			[   
                'process_group_id' 			        => 4,
				'process_sub_group_name' 			=> 'Oxy - Gas',
			],
			[   
                'process_group_id' 			        => 4,
				'process_sub_group_name' 			=> 'Labor',
			],
			[   
                'process_group_id' 			        => 4,
				'process_sub_group_name' 			=> 'Hydraulic Presser 1ST',
			],
			[   
                'process_group_id' 			        => 4,
				'process_sub_group_name' 			=> 'Hydraulic Presser 300T',
			],
			[   
                'process_group_id' 			        => 4,
				'process_sub_group_name' 			=> 'Milling - Vertical',
			],
			[   
                'process_group_id' 			        => 4,
				'process_sub_group_name' 			=> 'Milling - Universal',
			],
			[   
                'process_group_id' 			        => 5,
				'process_sub_group_name' 			=> 'Hand Drill',
			],
			[   
                'process_group_id' 			        => 5,
				'process_sub_group_name' 			=> 'Drilling - Radial',
			],
			[   
                'process_group_id' 			        => 5,
				'process_sub_group_name' 			=> 'Drilling - Horizontal',
			],
			[   
                'process_group_id' 			        => 5,
				'process_sub_group_name' 			=> 'Drilling - Vertical',
			],
			[   
                'process_group_id' 			        => 6,
				'process_sub_group_name' 			=> 'Shaper',
			],
			[   
                'process_group_id' 			        => 6,
				'process_sub_group_name' 			=> 'Milling - Horizontal',
			],
			[   
                'process_group_id' 			        => 6,
				'process_sub_group_name' 			=> 'Hobber',
			],
			[   
                'process_group_id' 			        => 6,
				'process_sub_group_name' 			=> 'Slotter',
			],
			[   
                'process_group_id' 			        => 7,
				'process_sub_group_name' 			=> 'Face Milling',
			],
			[   
                'process_group_id' 			        => 7,
				'process_sub_group_name' 			=> 'Milling - Horizontal',
			],
			[   
                'process_group_id' 			        => 7,
				'process_sub_group_name' 			=> 'Milling - Universal',
			],
			[   
                'process_group_id' 			        => 8,
				'process_sub_group_name' 			=> 'Hyd Portable Presser',
			],
			[   
                'process_group_id' 			        => 8,
				'process_sub_group_name' 			=> 'Oxy - Acetylene',
			],
			[   
                'process_group_id' 			        => 8,
				'process_sub_group_name' 			=> 'Hand Drill',
			],
			[   
                'process_group_id' 			        => 9,
				'process_sub_group_name' 			=> 'Lathe Machine - 3 feet (small)',
			],
			[   
                'process_group_id' 			        => 9,
				'process_sub_group_name' 			=> 'Lathe Machine - 5 feet (medium)',
			],
			[   
                'process_group_id' 			        => 9,
				'process_sub_group_name' 			=> 'Lathe Machine - Nigata (large)',
			],
			[   
                'process_group_id' 			        => 9,
				'process_sub_group_name' 			=> 'Lathe Machine - Osaka Kikai(large)',
			],
			[   
                'process_group_id' 			        => 10,
				'process_sub_group_name' 			=> 'Smaw',
			],
			[   
                'process_group_id' 			        => 10,
				'process_sub_group_name' 			=> 'TIG',
			],
			[   
                'process_group_id' 			        => 10,
				'process_sub_group_name' 			=> 'MIG/MAG',
			],
			[   
                'process_group_id' 			        => 10,
				'process_sub_group_name' 			=> 'Oxy-Acetylene',
			],
			
            
        ];
        
        foreach ($processsubgroups as $key => $value) {

            ProcessSubGroup::insert([
                'process_group_id'       => $value['process_group_id'],
                'process_sub_group_name' => $value['process_sub_group_name'],
            ]);
		}
    }
}
