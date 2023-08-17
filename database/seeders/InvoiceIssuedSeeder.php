<?php

namespace Database\Seeders;

use App\Models\InvoiceIssued;
use Illuminate\Database\Seeder;

class InvoiceIssuedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
			[

				'type' 			=> 'Sales Inv.',
			],
            [

				'type' 			=> 'Sales Order',
			],
        ];
        
        InvoiceIssued::insert($type);
    }
}
