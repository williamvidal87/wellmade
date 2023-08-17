<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
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

				'name' 			=> 'AA',
			],
            [

				'name' 			=> 'BA',
			],
            [

				'name' 			=> 'CA',
			],
            [

				'name' 			=> 'DA',
			],
            [

				'name' 			=> 'EA',
			],
            [

				'name' 			=> 'FA',
			],
            [

				'name' 			=> 'GA',
			],
            [

				'name' 			=> 'HA',
			],
            [

				'name' 			=> 'IA',
			],
            [

				'name' 			=> 'JA',
			],
            [

				'name' 			=> 'KA',
			],
        ];
        
        Industry::insert($list);
    }
}
