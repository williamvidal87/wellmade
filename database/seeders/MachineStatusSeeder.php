<?php

namespace Database\Seeders;

use App\Models\MachineStatus;
use Illuminate\Database\Seeder;

class MachineStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine_status = [
            [
                'machine_status' => 'In Use'
            ],
            [
                'machine_status' => 'Storage'
            ],
            [
                'machine_status' => 'Disposed'
            ],
            [
                'machine_status' => 'Donated'
            ],
            [
                'machine_status' => 'For Sale'
            ],
           
        ];
        foreach ($machine_status as $key => $value) {
            MachineStatus::insert([
               
                'machine_status' => $value['machine_status'],
            ]);
		}

    }
}
