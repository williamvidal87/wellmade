<?php

namespace Database\Seeders;

use App\Models\Subsidiary;
use Illuminate\Database\Seeder;

class SubsidiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Consilidated',
            ],
            [
                'name' => 'Unpaid Only',
            ],
            [
                'name' => 'Fully Paid',
            ],
            [
                'name' => 'Counter Receipts',
            ],
        ];

        foreach ($types as $key => $value) {
            Subsidiary::insert([
                'name' => $value['name'],
            ]);
        }
    }
}
