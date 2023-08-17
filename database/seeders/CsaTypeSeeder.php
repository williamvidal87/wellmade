<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CsaType;

class CsaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csa = [
			[

				'csa_type' => 'Office',
			],
            [

				'csa_type' => 'Salesman',
			],
            
        ];
        
        foreach ($csa as $key => $value) {
            CsaType::insert([
                'csa_type' => $value['csa_type'],
            ]);
		}
    }
}
