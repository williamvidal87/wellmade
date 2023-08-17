<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
			[
				'abbrv_bank' => 'MTBC',
				'bank_name' => 'Metrobank',
				'gl_account_id' => 4,
			],
			[
				'abbrv_bank' => 'BDO',
				'bank_name' => 'Banco De Oro Unibank',
				'gl_account_id' => 3,
			],
            
        ];
        
        Bank::insert($data);
    }
}
