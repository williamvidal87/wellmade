<?php

namespace Database\Seeders;

use App\Models\TransactionFor;
use Illuminate\Database\Seeder;

class ForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $for = [
			[   
                'type' 			        => 'SPQ'
			],
			[   
                'type' 			        => 'BSN'
			],
            
        ];
        
        foreach ($for as $key => $value) {

            TransactionFor::insert([
                'type'       => $value['type'],
            ]);
		}
    }
}
