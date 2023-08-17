<?php

namespace Database\Seeders;

use App\Models\MachineUnit;
use Illuminate\Database\Seeder;

class MachineUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $machine_unit = [
            [
                'machine_unit_name' => 'Amperes'
            ],
            [
                 'machine_unit_name' => 'Computer'
            ],
            [
                'machine_unit_name' => 'Feet'
            ],
            [
                'machine_unit_name' => 'HoresPower'
            ],
            [
                'machine_unit_name' => 'Inches'
            ],
            [
                'machine_unit_name' => 'Printer'
            ],
            [
                'machine_unit_name' => 'Projector'
            ],
            [
                'machine_unit_name' => 'Tons'
            ],
            [
                'machine_unit_name' => 'Watts'
            ],
        ];
        foreach ($machine_unit as $key => $value) {
            MachineUnit::insert([
            
                'machine_unit_name' => $value['machine_unit_name'],
            ]);
        }
    }
}
