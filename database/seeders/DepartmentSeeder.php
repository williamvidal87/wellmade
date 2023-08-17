<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = [
            [
                'name' => 'Calibration'
            ],
            [
                'name' => 'ER'
            ],
            [
                'name' => 'Maintenance'
            ],
            [
                'name' => 'MF'
            ],
            [
                'name' => 'NC'
            ],
            [
                'name' => 'Office'
            ],
            [
                'name' => 'Office Supp'
            ]
        ];

        foreach($department as $key => $value) {

            Department::insert([
                'name'  =>$value['name'],
            ]);
        }
    }
}
