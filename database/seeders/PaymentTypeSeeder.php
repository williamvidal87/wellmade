<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
			[
				'type' 			=> 'Cash',
			],
            [
				'type' 			=> 'Credit',
			],
            [
				'type' 			=> 'Cheque',
			],
        ];
        
        PaymentType::insert($type);
    }
}
