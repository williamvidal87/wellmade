<?php

namespace Database\Seeders;

use App\Models\SubGroupRates;
use Illuminate\Database\Seeder;

class SubGroupRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_group_rates = [
			[
				
				'group_id' 			=>    1,
				'sub_group' 		=> 'Lathe',
			],
			[
				
				'group_id' 			=>    1,
				'sub_group' 		=> 'Weld',
			],
			[
				
				'group_id' 			=>    1,
				'sub_group' 		=> 'Mill',
			],
			[
				
				'group_id' 			=>    1,
				'sub_group' 		=> 'Shaper',
			],
			[
				
				'group_id' 			=>    1,
				'sub_group' 		=> 'Bal',
			],
			[
				
				'group_id' 			=>    1,
				'sub_group' 		=> 'Labor',
			],
			[
				
				'group_id' 			=>    1,
				'sub_group' 		=> 'BMill',
			],
			[
				
				'group_id' 			=>    1,
				'sub_group' 		=> 'Bore',
			],
			[
				
				'group_id' 			=>    1,
				'sub_group' 		=> 'KMILL',
			],[
				
				'group_id' 			=>    2,
				'sub_group' 		=> 'Lathe',
			],
			[
				
				'group_id' 			=>    2,
				'sub_group' 		=> 'Weld',
			],
			[
				
				'group_id' 			=>    2,
				'sub_group' 		=> 'Mill',
			],
			[
				
				'group_id' 			=>    2,
				'sub_group' 		=> 'Shaper',
			],
			[
				
				'group_id' 			=>    2,
				'sub_group' 		=> 'Bal',
			],
			[
				
				'group_id' 			=>    2,
				'sub_group' 		=> 'Labor',
			],
			[
				
				'group_id' 			=>    2,
				'sub_group' 		=> 'BMill',
			],
			[
				
				'group_id' 			=>    2,
				'sub_group' 		=> 'Bore',
			],
			[
				
				'group_id' 			=>    2,
				'sub_group' 		=> 'KMILL',
			],
            [   
				'group_id' 			=>    3,
				'sub_group' 	    => 'Weld',
			],
            [   
				'group_id' 			=>    4,
				'sub_group' 	    => 'Lathe',
			],
            [   
				'group_id' 			=>    5,
				'sub_group' 		=> 'Milling',
			],
			[   
				'group_id' 			=>    6,
				'sub_group' 		=> 'Lathe',
			],
			[   
				'group_id' 			=>    7,
				'sub_group' 		=> 'Milling',
			],
			[   
				'group_id' 			=>    8,
				'sub_group' 		=> 'Labor',
			],
			
			[   
				'group_id' 			=>    9,
				'sub_group' 		=> 'Labor',
			],
			[
				'group_id' 			=> null,
				'sub_group' 		=> 'Inject',
			],
			[   
				'group_id' 			=> null,
				'sub_group' 		=> 'Pump',
			],
			
            
        ];
        
        foreach ($sub_group_rates as $key => $value) {

            SubGroupRates::insert([ 
                'group_id' => $value['group_id'],
                'sub_group' => $value['sub_group'],
            ]);
		}
    }
}
