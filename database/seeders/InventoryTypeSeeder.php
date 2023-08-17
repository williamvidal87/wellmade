<?php

namespace Database\Seeders;

use App\Models\InventoryType;
use Illuminate\Database\Seeder;

class InventoryTypeSeeder extends Seeder
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

				'type' 			=> 'Supply',
			],
            [

				'type' 			=> 'Asset',
			],
        ];
        
        InventoryType::insert($list);
    }
}
