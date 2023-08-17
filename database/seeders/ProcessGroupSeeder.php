<?php

namespace Database\Seeders;

use App\Models\ProcessGroup;
use Illuminate\Database\Seeder;

class ProcessGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $processgroups = [
			[
				'process_group_name' 			=> 'ASSEMBLING',
			],
			[
				'process_group_name' 		    => 'Cleaning and Measurement',
			],
            [
				'process_group_name' 			=> 'CUTTING',
			],
            [
				'process_group_name' 			=> 'DISMANTLING',
			],
            [
				'process_group_name' 			=> 'DRILLNG',
			],
            [
				'process_group_name' 			=> 'GEARING',
			],
            [
				'process_group_name' 			=> 'MILLING',
			],
            [
				'process_group_name' 			=> 'ON-SITE/ IN PLACE ',
			],
            [
				'process_group_name' 			=> 'TURNING',
			],
            [
				'process_group_name' 			=> 'WELDING',
			],
			
            
        ];
        
        foreach ($processgroups as $key => $value) {

            ProcessGroup::insert([
                'process_group_name' => $value['process_group_name'],
            ]);
		}
    }
}
