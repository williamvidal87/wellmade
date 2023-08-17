<?php

namespace Database\Seeders;

use App\Models\MachineSubGroupName;
use Illuminate\Database\Seeder;

class MachineSubGroupNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machinesubgroupname=[
            [
                'machine_sub_group_name' => 'Head',
            ],
            [
                'machine_sub_group_name' => 'Portable On-Site',
            ],
            [
                'machine_sub_group_name' => 'Blocks',
            ],
            [
                'machine_sub_group_name' => 'Crankshaft',
            ],
            [
                'machine_sub_group_name' => 'Head & Block',
            ],
            [
                'machine_sub_group_name' => 'Conrod Assy',
            ],
            [
                'machine_sub_group_name' => 'Universal',
            ],
            [
                'machine_sub_group_name' => 'Horizontal',
            ],
            [
                'machine_sub_group_name' => 'Vertical',
            ],
            [
                'machine_sub_group_name' => 'SMAW',
            ],
            [
                'machine_sub_group_name' => 'MIG',
            ],
            [
                'machine_sub_group_name' => 'TIG',
            ],
            [
                'machine_sub_group_name' => 'Computer',
            ],
            [
                'machine_sub_group_name' => 'Car/Truck',
            ],
            [
                'machine_sub_group_name' => 'Motorcycle',
            ],
            [
                'machine_sub_group_name' => 'Window Type',
            ],
            [
                'machine_sub_group_name' => 'Split Type',
            ],
            [
                'machine_sub_group_name' => 'Portable',
            ],
            [
                'machine_sub_group_name' => 'Projector',
            ],
            [
                'machine_sub_group_name' => 'Injection Pumps',
            ],
            [
                'machine_sub_group_name' => 'Injectors',
            ],
            [
                'machine_sub_group_name' => 'Printer',
            ],
            [
                'machine_sub_group_name' => 'Flat Surface',
            ],
            [
                'machine_sub_group_name' => 'Cylindrical',
            ],
            [
                'machine_sub_group_name' => 'Valve Seats',
            ],
            [
                'machine_sub_group_name' => 'Disc/Drums',
            ],
            [
                'machine_sub_group_name' => 'Oxy/Gas/Aceytelene',
            ],
            [
                'machine_sub_group_name' => 'Plasma',
            ],
            [
                'machine_sub_group_name' => 'Lifter',
            ],
                ];
        foreach ($machinesubgroupname as $key => $value) {
            MachineSubGroupName::insert([
                'machine_sub_group_name' => $value['machine_sub_group_name'],
            ]);
		}
    }
}
