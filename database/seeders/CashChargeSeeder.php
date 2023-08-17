<?php

namespace Database\Seeders;

use App\Models\CashCharge;
use Illuminate\Database\Seeder;

class CashChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
			[
				'name' => 'Cash',
			],
            [
				'name' => 'Charge',
			],
        ];
        
        foreach ($names as $key => $value) {
            CashCharge::insert([
                'name' => $value['name'],
            ]);
		}
    }
}
