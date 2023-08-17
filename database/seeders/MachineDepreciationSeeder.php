<?php

namespace Database\Seeders;

use App\Models\MachineDepreciation;
use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

class MachineDepreciationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine_depreciation = [
            [
                'machine_depreciation_number' => '1'
            ],
            [
                'machine_depreciation_number' => '2'
            ],
            [
                'machine_depreciation_number' => '3'
            ],
            [
                'machine_depreciation_number' => '4'
            ],
            [
                'machine_depreciation_number' => '5'
            ],
            [
                'machine_depreciation_number' => '6'
            ],
            [
                'machine_depreciation_number' => '7'
            ],
            [
                'machine_depreciation_number' => '8'
            ],
            [
                'machine_depreciation_number' => '9'
            ],
            [
                'machine_depreciation_number' => '10'
            ],
            
        ];
        foreach ($machine_depreciation as $key => $value) {
            MachineDepreciation::insert([
            
                'machine_depreciation_number' => $value['machine_depreciation_number'],
            ]);
        }
    }
}
