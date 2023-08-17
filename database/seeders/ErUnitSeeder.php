<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use App\Models\ErUnit;

class ErUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list =[
            [
                'unit' => 'Assyble',
            ],
            [
                'unit' => 'Bore',
            ],
            [
                'unit' => 'Housing',
            ],
            [
                'unit' => 'Journals',
            ],
            [
                'unit' => 'Pieces',
            ],
        ];
        
        ErUnit::insert($list);
    }
}
