<?php

namespace Database\Seeders;

use App\Models\MachineModelName;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

use function Ramsey\Uuid\v1;

class MachineModelNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machineModelName = [
            [
                'machine_model_name' => 'D24'
            ],
            [
                'machine_model_name' => 'YC-300WP'
            ],
            [
                'machine_model_name' => '0269'
            ],
            [
                'machine_model_name' => '096'
            ],
            [
                'machine_model_name' => '155'
            ],
            [
                'machine_model_name' => '2500'
            ],
            [
                'machine_model_name' => 'CHINA'
            ],
            [
                'machine_model_name' => 'd-269'
            ],
            [
                'machine_model_name' => 'ENGLAND'
            ],
            [
                'machine_model_name' => 'EOF'
            ],
            [
                'machine_model_name' => 'GERMANY'
            ],
            [
                'machine_model_name' => 'HC-392'
            ],
            [
                'machine_model_name' => 'HITACHI'
            ],  [
                'machine_model_name' => 'JAPAN'
            ],
            [
                'machine_model_name' => 'KW 092'
            ],
            [
                'machine_model_name' => 'kwikway'
            ],
            [
                'machine_model_name' => 'MITSUBISHI'
            ],
            [
                'machine_model_name' => 'no model'
            ],
            [
                'machine_model_name' => 'NSP'
            ],
            [
                'machine_model_name' => 'SD23'
            ],
            [
                'machine_model_name' => 'TOYO OKI'
            ],
            [
                'machine_model_name' => 'TS-BHN'
            ],
            [
                'machine_model_name' => 'V.2'
            ]           

        ];

        foreach ($machineModelName as $key => $value) {
            MachineModelName::insert([
               
                'machine_model_name' => $value['machine_model_name'],
            ]);
		}
    }
}
