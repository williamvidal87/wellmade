<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ErWorkGroup;

class ERWorkGroupSeeder extends Seeder
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
                'er_work_group_name' => 'CrankShaft',
            ],
            [
                'er_work_group_name' => 'Cylinder Blocks',
            ],
            [
                'er_work_group_name' => 'Conrod Arm',
            ],
            [
                'er_work_group_name' => 'Cylinder Head Assymble',
            ],
            [
                'er_work_group_name' => 'Miscelaneous',
            ],
        ];
        
        ErWorkGroup::insert($list);
    }
}
