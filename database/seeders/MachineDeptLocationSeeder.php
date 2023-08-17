<?php

namespace Database\Seeders;

use App\Models\MachineDeptLocation;
use Illuminate\Database\Seeder;

class MachineDeptLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine_dept_location = [
            [
                'machine_dept_location_name' => 'Admin'
            ],
            [
                'machine_dept_location_name' => 'Bohol'
            ],
            [
                'machine_dept_location_name' => 'Calibration'
            ],
            [
                'machine_dept_location_name' => 'Engine Rebuilding(ER)'
            ],
            [
                'machine_dept_location_name' => 'Finance'
            ],
            [
                'machine_dept_location_name' => 'GM'
            ],
            [
                'machine_dept_location_name' => 'Machining & Fabrication(MF)'
            ],
            [
                'machine_dept_location_name' => 'Maintenance'
            ],
            [
                'machine_dept_location_name' => 'Manufacturing'
            ],
            [
                'machine_dept_location_name' => 'Operation'
            ],
            [
                'machine_dept_location_name' => 'Portable On-Site, Warehouse'
            ],
            [
                'machine_dept_location_name' => 'Power Tools'
            ],
            [
                'machine_dept_location_name' => 'Rehabilation'
            ],
            [
                'machine_dept_location_name' => 'Warehouse'
            ],
           
        ];
        foreach ($machine_dept_location as $key => $value) {
            MachineDeptLocation::insert([
               
                'machine_dept_location_name' => $value['machine_dept_location_name'],
            ]);
		}
    }
}
