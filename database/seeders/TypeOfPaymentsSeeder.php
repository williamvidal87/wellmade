<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeOfPayment;

class TypeOfPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
			[

				'payment_type' => 'Over The Counter',
			],
            [

				'payment_type' => 'Cash On Hand',
			],
            
        ];
        
        TypeOfPayment::insert($data);
    }
}
