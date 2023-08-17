<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountTypeSeeder extends Seeder
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

				'discount' 			=> '%',
			],
            [

				'discount' 			=> '₱',
			],
        ];
        
        Discount::insert($list);
    }
}
