<?php

namespace Database\Seeders;

use App\Models\Remark;
use Illuminate\Database\Seeder;

class RemarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $remarks = [
            [
                'type' 			=> 'Credit with P.O. approved by Finance',
            ],
            [
                'type' 			=> 'Credit without P.O. approved by Finance',
            ],
            [
                'type' 			=> 'Full CASH Payment required',
            ],
            [
                'type' 			=> 'Owner\'s Risk, not covered by warranty',
            ],
            [
                'type' 			=> 'Partial Payment approved by Finance',
            ],
            [
                'type' 			=> 'Payment Guaranteed by CSA',
            ],
            [
                'type' 			=> 'Receive Original for Processing of Payment',
            ],
        ];
        
        foreach ($remarks as $key => $value) {

            Remark::insert([
                'type' => $value['type'],
            ]);
		}
    }
}
