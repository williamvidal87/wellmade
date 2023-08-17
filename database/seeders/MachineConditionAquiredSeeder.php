<?php

namespace Database\Seeders;

use App\Models\MachineConditionAquired;
use Illuminate\Database\Seeder;

class MachineConditionAquiredSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine_condition_aquired = [
            [
                'machine_condition_acquired_name' => 'Brand New'
            ],
            [
                'machine_condition_acquired_name' => 'Re-Conditioned'
            ],
            [
                'machine_condition_acquired_name' => 'Surplus AS-IS'
            ],
        ];
        foreach ($machine_condition_aquired as $key => $value) {
            MachineConditionAquired::insert([
            
                'machine_condition_acquired_name' => $value['machine_condition_acquired_name'],
            ]);
        }
    }
}
