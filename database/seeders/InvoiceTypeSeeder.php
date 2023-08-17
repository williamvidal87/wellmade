<?php

namespace Database\Seeders;

use App\Models\InvoiceTypes;
use Illuminate\Database\Seeder;

class InvoiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
			[

				'invoice_type' 			=> 'SB',
			],
            [

				'invoice_type' 			=> 'WV',
			],
        ];
        
        InvoiceTypes::insert($list);
    }
}
