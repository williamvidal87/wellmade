<?php

namespace Database\Seeders;

use App\Models\VoucherType;
use Illuminate\Database\Seeder;

class VoucherTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type =[
            [
                'type' => 'Misc. Payments',
            ],
            [
                'type' => 'Supplier Invs.',
            ],
        ];
        
        foreach ($type as $key => $value) {
            VoucherType::insert([
                'type' => $value['type'],
            ]);
		}
    }
}
