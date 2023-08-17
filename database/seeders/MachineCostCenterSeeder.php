<?php

namespace Database\Seeders;

use App\Models\MachineCostCenter;
use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

class MachineCostCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine_cost_center = [
            [
                'machine_cost_center_name' => 'Admin & Finance'
            ],
            [
                'machine_cost_center_name' => 'Duratect'
            ],
            [
                'machine_cost_center_name' => 'Engine'
            ],
            [
                'machine_cost_center_name' => 'Franchise'
            ],
            [
                'machine_cost_center_name' => 'Gear & Milling'
            ],
            [
                'machine_cost_center_name' => 'Machining'
            ],
            [
                'machine_cost_center_name' => 'Operation'
            ],
        ];
        foreach ($machine_cost_center as $key => $value) {
            MachineCostCenter::insert([
               
                'machine_cost_center_name' => $value['machine_cost_center_name'],
            ]);
		}
    }
}
