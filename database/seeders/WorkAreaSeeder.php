<?php

namespace Database\Seeders;

use App\Models\WorkArea;
use Illuminate\Database\Seeder;

class WorkAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $work_area = [
            [
                'name' => 'ER-On-Site'
            ],
            [
                'name' => 'ER-Bench Works'
            ],
            [
                'name' => 'ER-Boring'
            ],
            [
                'name' => 'ER-Calibration'
            ],
            [
                'name' => 'ER-Control Resizing'
            ],
            [
                'name' => 'ER-Grinding'
            ],
            [
                'name' => 'ER-Honing'
            ],
            [
                'name' => 'ER-Lathe Works'
            ],
            [
                'name' => 'ER-Line Boring'
            ],
            [
                'name' => 'ER-Surfacing'
            ],
            [
                'name' => 'ER-Tig Welding'
            ],
            [
                'name' => 'ER-Valve and Valve Seat Re-facing'
            ],
            [
                'name' => 'ER-Washing'
            ],
            [
                'name' => 'ER-Welding SMAW'
            ],
            [
                'name' => 'MF-Bench Works'
            ],
            [
                'name' => 'MF-Gear Milling'
            ],
            [
                'name' => 'MF-Lathe Works'
            ],
            [
                'name' => 'MF-On-Site'
            ],
            [
                'name' => 'MF-Welding SMAW'
            ],
            [
                'name' => 'MF-Welding TIG'
            ],
            [
                'name' => 'OFFICE-Finance'
            ],
            [
                'name' => 'OFFICE-Operation'
            ],
            [
                'name' => 'OFFICE-Warehouse'
            ]
        ];

        foreach($work_area as $key => $value) {

            WorkArea::insert([
                'name'  =>$value['name'],
            ]);
        }
    }
}
