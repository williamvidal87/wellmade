<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncentiveType;

class IncentiveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
			[

				'incentive_type' 			=> '5',
			],
            [

				'incentive_type' 			=> '10',
			],
            [

				'incentive_type' 			=> '15',
			],
            [

				'incentive_type' 			=> '20',
			],
            [

				'incentive_type' 			=> '25',
			],
            [

				'incentive_type' 			=> '30',
			],
            [

				'incentive_type' 			=> '55',
			],
            [

				'incentive_type' 			=> '40',
			],
            [

				'incentive_type' 			=> '45',
			],
            [

				'incentive_type' 			=> '50',
			],
            [

				'incentive_type' 			=> '55',
			],
            [

				'incentive_type' 			=> '60',
			],
            [

				'incentive_type' 			=> '65',
			],
            [

				'incentive_type' 			=> '70',
			],
            [

				'incentive_type' 			=> '75',
			],
            [

				'incentive_type' 			=> '80',
			],
            [

				'incentive_type' 			=> '85',
			],
            [

				'incentive_type' 			=> '90',
			],
            [

				'incentive_type' 			=> '95',
			],
            [

				'incentive_type' 			=> '100',
			],
        ];
        
        IncentiveType::insert($list);
    }
}
