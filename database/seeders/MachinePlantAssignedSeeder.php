<?php

namespace Database\Seeders;

use App\Models\MachinePlantAssigned;
use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

class MachinePlantAssignedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machinePlantAssigned = [
            [
                'machine_plant_assigned_name' => 'Northern'
            ],
            [
                'machine_plant_assigned_name' => 'Central'
            ],
            [
                'machine_plant_assigned_name' => 'Pelayo'
            ],
            [
                'machine_plant_assigned_name' => 'Carcheck'
            ],
            [
                'machine_plant_assigned_name' => 'Dumaguete'
            ],
           
        ];
        foreach ($machinePlantAssigned as $key => $value) {
            MachinePlantAssigned::insert([
               
                'machine_plant_assigned_name' => $value['machine_plant_assigned_name'],
            ]);
		}

    }
}
