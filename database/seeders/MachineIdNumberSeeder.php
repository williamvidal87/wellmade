<?php

namespace Database\Seeders;

use App\Models\MachineIdNumber;
use Illuminate\Database\Seeder;

class MachineIdNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machineidnumber=[
            [
                'machine_id_number' => '100',
            ],
            [
                'machine_id_number' => '101',
            ],
            [
                'machine_id_number' => '102',
            ],
            [
                'machine_id_number' => '103',
            ],
            [
                'machine_id_number' => '104',
            ],
            [
                'machine_id_number' => '105',
            ],
            [
                'machine_id_number' => '106',
            ],
            [
                'machine_id_number' => '107',
            ],
            [
                'machine_id_number' => '108',
            ],
            [
                'machine_id_number' => '109',
            ],
            [
                'machine_id_number' => '110',
            ],
            [
                'machine_id_number' => '111',
            ],
            [
                'machine_id_number' => '112',
            ],
            [
                'machine_id_number' => '113',
            ],
            [
                'machine_id_number' => '114',
            ],
            [
                'machine_id_number' => '115',
            ],
            [
                'machine_id_number' => '200',
            ],
            [
                'machine_id_number' => '201',
            ],
            [
                'machine_id_number' => '202',
            ],
            [
                'machine_id_number' => '203',
            ],
            [
                'machine_id_number' => '204',
            ],
            [
                'machine_id_number' => '205',
            ],
            [
                'machine_id_number' => '206',
            ],
            [
                'machine_id_number' => '207',
            ],
            [
                'machine_id_number' => '208',
            ],
            [
                'machine_id_number' => '209',
            ],
            [
                'machine_id_number' => '210',
            ],
            [
                'machine_id_number' => '211',
            ],
            [
                'machine_id_number' => '212',
            ],
            [
                'machine_id_number' => '213',
            ],
            [
                'machine_id_number' => '214',
            ],
            [
                'machine_id_number' => '215',
            ],
            [
                'machine_id_number' => '300',
            ],
            [
                'machine_id_number' => '301',
            ],
            [
                'machine_id_number' => '302',
            ],
            [
                'machine_id_number' => '303',
            ],
            [
                'machine_id_number' => '304',
            ],
            [
                'machine_id_number' => '305',
            ],
            [
                'machine_id_number' => '306',
            ],
            [
                'machine_id_number' => '307',
            ],
            [
                'machine_id_number' => '308',
            ],
            [
                'machine_id_number' => '309',
            ],
            [
                'machine_id_number' => '310',
            ],
            [
                'machine_id_number' => '311',
            ],
            [
                'machine_id_number' => '312',
            ],
            [
                'machine_id_number' => '313',
            ],
            [
                'machine_id_number' => '314',
            ],
            [
                'machine_id_number' => '315',
            ],
            
            [
                'machine_id_number' => '400',
            ],
            [
                'machine_id_number' => '401',
            ],
            [
                'machine_id_number' => '402',
            ],
            [
                'machine_id_number' => '403',
            ],
            [
                'machine_id_number' => '404',
            ],
            [
                'machine_id_number' => '405',
            ],
            [
                'machine_id_number' => '406',
            ],
            [
                'machine_id_number' => '407',
            ],
            [
                'machine_id_number' => '408',
            ],
            [
                'machine_id_number' => '409',
            ],
            [
                'machine_id_number' => '410',
            ],
            [
                'machine_id_number' => '411',
            ],
            [
                'machine_id_number' => '412',
            ],
            [
                'machine_id_number' => '413',
            ],
            [
                'machine_id_number' => '414',
            ],
            [
                'machine_id_number' => '415',
            ],
            [
                'machine_id_number' => '500',
            ],
            [
                'machine_id_number' => '501',
            ],
            [
                'machine_id_number' => '502',
            ],
            [
                'machine_id_number' => '503',
            ],
            [
                'machine_id_number' => '504',
            ],
            [
                'machine_id_number' => '505',
            ],
            [
                'machine_id_number' => '506',
            ],
            [
                'machine_id_number' => '507',
            ],
            [
                'machine_id_number' => '508',
            ],
            [
                'machine_id_number' => '509',
            ],
            [
                'machine_id_number' => '510',
            ],
            [
                'machine_id_number' => '511',
            ],
            [
                'machine_id_number' => '512',
            ],
            [
                'machine_id_number' => '513',
            ],
            [
                'machine_id_number' => '514',
            ],
            [
                'machine_id_number' => '515',
            ],
            [
                'machine_id_number' => '600',
            ],
            [
                'machine_id_number' => '601',
            ],
            [
                'machine_id_number' => '602',
            ],
            [
                'machine_id_number' => '603',
            ],
            [
                'machine_id_number' => '604',
            ],
            [
                'machine_id_number' => '605',
            ],
            [
                'machine_id_number' => '606',
            ],
            [
                'machine_id_number' => '607',
            ],
            [
                'machine_id_number' => '608',
            ],
            [
                'machine_id_number' => '609',
            ],
            [
                'machine_id_number' => '610',
            ],
            [
                'machine_id_number' => '611',
            ],
            [
                'machine_id_number' => '612',
            ],
            [
                'machine_id_number' => '613',
            ],
            [
                'machine_id_number' => '614',
            ],
            [
                'machine_id_number' => '615',
            ],
                ];
        foreach ($machineidnumber as $key => $value) {
            MachineIdNumber::insert([
                'machine_id_number' => $value['machine_id_number'],
            ]);
		}
    }
}
