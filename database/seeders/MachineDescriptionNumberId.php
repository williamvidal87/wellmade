<?php

namespace Database\Seeders;

use App\Models\MachineDescription;
use Illuminate\Database\Seeder;

class MachineDescriptionNumberId extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $machinedescriptionnumberid=[
            [
                'machine_description_number_id' => 1,
                'description'                   => 'AirCon'
            ],
            [
                'machine_description_number_id' => 2,
                'description'                   => 'Bench Grinder'
            ],
            [
                'machine_description_number_id' => 3,
                'description'                   => 'Boring'
            ],
            [
                'machine_description_number_id' => 4,
                'description'                   => 'Calibration machine'
            ],
            [
                'machine_description_number_id' => 5,
                'description'                   => 'Compressor'
            ],
            [
                'machine_description_number_id' => 6,
                'description'                   => 'CONROD HONING'
            ],
            [
                'machine_description_number_id' => 7,
                'description'                   => 'Conrod Resizer'
            ],
            [
                'machine_description_number_id' => 8,
                'description'                   => 'Crankshaft Grinder'
            ],
            [
                'machine_description_number_id' => 9,
                'description'                   => 'CUTTING MACHINE'
            ],
            [
                'machine_description_number_id' => 10,
                'description'                   => 'Drill Press'
            ],
            [
                'machine_description_number_id' => 11,
                'description'                   => 'Electric Fan'
            ],
            [
                'machine_description_number_id' => 12,
                'description'                   => 'General Repair'
            ],
            [
                'machine_description_number_id' => 13,
                'description'                   => 'Honing'
            ],
            [
                'machine_description_number_id' => 14,
                'description'                   => 'Lathe Machine'
            ],
            [
                'machine_description_number_id' => 15,
                'description'                   => 'Line Boring Machine'
            ],
            [
                'machine_description_number_id' => 16,
                'description'                   => 'Milling'
            ],
            [
                'machine_description_number_id' => 17,
                'description'                   => 'Nozzle Tester'
            ],
            [
                'machine_description_number_id' => 18,
                'description'                   => 'Oxy-Gasul'
            ],
            [
                'machine_description_number_id' => 19,
                'description'                   => 'Power Hacksaw'
            ],
            [
                'machine_description_number_id' => 20,
                'description'                   => 'Presser'
            ],
            [
                'machine_description_number_id' => 21,
                'description'                   => 'Pressure Washer'
            ],
            [
                'machine_description_number_id' => 22,
                'description'                   => 'Surface Grinder'
            ],
            [
                'machine_description_number_id' => 23,
                'description'                   => 'TIG Welding Machine'
            ],
            [
                'machine_description_number_id' => 24,
                'description'                   => 'Transportation'
            ],
            [
                'machine_description_number_id' => 25,
                'description'                   => 'Valve Refacer'
            ],
            [
                'machine_description_number_id' => 26,
                'description'                   => 'Valve Seat'
            ],
            [
                'machine_description_number_id' => 27,
                'description'                   => 'Welding Machine(SMAW)'
            ],
            ];
        foreach ($machinedescriptionnumberid as $key => $value) {
            MachineDescription::insert([
                'machine_description_number_id' => $value['machine_description_number_id'],
                'description'                   => $value['description'],
            ]);
		}
    }
}
