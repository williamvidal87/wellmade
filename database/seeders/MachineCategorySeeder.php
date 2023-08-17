<?php

namespace Database\Seeders;

use App\Models\MachineCategory;
use Illuminate\Database\Seeder;

class MachineCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machinecategory=[
            [
                'machine_category_name' => 'MAA',
            ],
            [
                'machine_category_name' => 'MAB',
            ],
            [
                'machine_category_name' => 'MAC',
            ],
            [
                'machine_category_name' => 'MAD',
            ],
            [
                'machine_category_name' => 'MAE',
            ],
            [
                'machine_category_name' => 'MAF',
            ],
            [
                'machine_category_name' => 'MAG',
            ],
            [
                'machine_category_name' => 'MAH',
            ],
            [
                'machine_category_name' => 'MAI',
            ],
            [
                'machine_category_name' => 'MAJ',
            ],
            [
                'machine_category_name' => 'MAK',
            ],
            [
                'machine_category_name' => 'MAL',
            ],
            [
                'machine_category_name' => 'MAM',
            ],
            [
                'machine_category_name' => 'MAN',
            ],
            [
                'machine_category_name' => 'MAO',
            ],
            [
                'machine_category_name' => 'MAP',
            ],
            [
                'machine_category_name' => 'MAQ',
            ],
            [
                'machine_category_name' => 'MAR',
            ],
            [
                'machine_category_name' => 'MAS',
            ],
            [
                'machine_category_name' => 'MAT',
            ],
            [
                'machine_category_name' => 'MAU',
            ],
            [
                'machine_category_name' => 'MAV',
            ],
            [
                'machine_category_name' => 'MAW',
            ],
            [
                'machine_category_name' => 'MAX',
            ],
            [
                'machine_category_name' => 'MAY',
            ],
            [
                'machine_category_name' => 'MAZ',
            ],
            [
                'machine_category_name' => 'MBA',
            ],
            [
                'machine_category_name' => 'MBB',
            ],
            [
                'machine_category_name' => 'MBC',
            ],
            [
                'machine_category_name' => 'MBD',
            ],
            [
                'machine_category_name' => 'MBE',
            ],
            [
                'machine_category_name' => 'MBF',
            ],
            [
                'machine_category_name' => 'MBG',
            ],
            [
                'machine_category_name' => 'MBH',
            ],
            [
                'machine_category_name' => 'MBI',
            ],
            [
                'machine_category_name' => 'MBJ',
            ],
            [
                'machine_category_name' => 'MBK',
            ],
            [
                'machine_category_name' => 'MBL',
            ],
            [
                'machine_category_name' => 'MBM',
            ],
            [
                'machine_category_name' => 'MBN',
            ],
            [
                'machine_category_name' => 'MBO',
            ],
            [
                'machine_category_name' => 'MBP',
            ],
            [
                'machine_category_name' => 'MBQ',
            ],
            [
                'machine_category_name' => 'MBR',
            ],
            [
                'machine_category_name' => 'MBS',
            ],
            [
                'machine_category_name' => 'MBT',
            ],
            [
                'machine_category_name' => 'MBU',
            ],
            [
                'machine_category_name' => 'MBV',
            ],
            [
                'machine_category_name' => 'MBW',
            ],
            [
                'machine_category_name' => 'MBX',
            ],
            [
                'machine_category_name' => 'MBY',
            ],
            [
                'machine_category_name' => 'MBZ',
            ],
            [
                'machine_category_name' => 'MCA',
            ],
            [
                'machine_category_name' => 'MCB',
            ],
            [
                'machine_category_name' => 'MCC',
            ],
            [
                'machine_category_name' => 'MCD',
            ],
            [
                'machine_category_name' => 'MCE',
            ],
            [
                'machine_category_name' => 'MCF',
            ],
            [
                'machine_category_name' => 'MCG',
            ],
            [
                'machine_category_name' => 'MCH',
            ],
            [
                'machine_category_name' => 'MCI',
            ],
            [
                'machine_category_name' => 'MCJ',
            ],
            [
                'machine_category_name' => 'MCK',
            ],
            [
                'machine_category_name' => 'MCL',
            ],
            [
                'machine_category_name' => 'MCM',
            ],
            [
                'machine_category_name' => 'MCN',
            ],
            [
                'machine_category_name' => 'MCO',
            ],
            [
                'machine_category_name' => 'MCP',
            ],
            [
                'machine_category_name' => 'MCQ',
            ],
            [
                'machine_category_name' => 'MCR',
            ],
            [
                'machine_category_name' => 'MCS',
            ],
            [
                'machine_category_name' => 'MCT',
            ],
            [
                'machine_category_name' => 'MCU',
            ],
            [
                'machine_category_name' => 'MCV',
            ],
            [
                'machine_category_name' => 'MCW',
            ],
            [
                'machine_category_name' => 'MCX',
            ],
            [
                'machine_category_name' => 'MCY',
            ],
            [
                'machine_category_name' => 'MCZ',
            ],
            
                ];
        foreach ($machinecategory as $key => $value) {
            MachineCategory::insert([
                'machine_category_name' => $value['machine_category_name'],
            ]);
		}
    }
}
