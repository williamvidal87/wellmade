<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CylinderList;

class CylinderListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'cylinder' => 4
            ],
            [
                'cylinder' => 6
            ],
            [
                'cylinder' => 8
            ],
            [
                'cylinder' => 10
            ],
            [
                'cylinder' => 12
            ],
        ];
    
        CylinderList::insert($list);
    }
}
