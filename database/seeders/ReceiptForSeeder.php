<?php

namespace Database\Seeders;

use App\Models\ReceiptFor;
use Illuminate\Database\Seeder;

class ReceiptForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $receiptFor = [
			[   
                'type' 			        => 'Misc. Receipt'
			],
			[   
                'type' 			        => 'Invoices'
			],
            
        ];
        
        foreach ($receiptFor as $key => $value) {

            ReceiptFor::insert([
                'type'       => $value['type'],
            ]);
		}
    }
}
