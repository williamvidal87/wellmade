<?php

namespace Database\Seeders;

use App\Models\ReceiptTypes;
use Illuminate\Database\Seeder;

class ReceiptTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $receiptType = [
			[   
                'receipt_type' 			        => 'Acknowledgement Receipt'
			],
			[   
                'receipt_type' 			        => 'Official Receipt'
			],
            
        ];
        
        foreach ($receiptType as $key => $value) {

            ReceiptTypes::insert([
                'receipt_type'       => $value['receipt_type'],
            ]);
		}
    }
}
