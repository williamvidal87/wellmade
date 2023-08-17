<?php

namespace Database\Seeders;

use App\Models\TypeOfPayment;
use Illuminate\Database\Seeder;

class TypeOfPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_types = [
			[
				'payment_type' => 'C.O.D',
			],
            [
				'payment_type' => 'O.T.C',
			],
        ];
        
        foreach ($payment_types as $key => $value) {
            TypeOfPayment::insert([
                'payment_type' => $value['payment_type'],
            ]);
		}
    }
}
