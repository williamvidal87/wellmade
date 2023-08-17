<?php

namespace Database\Seeders;

use App\Models\MachinePurchaseFrom;
use Illuminate\Database\Seeder;

class MachinePurchaseFromSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine_purchase_from = [
            [
                'machine_purchase_from_name' => 'Rejoice Hardware and Electrical Supply'
            ],
            [
                'machine_purchase_from_name' => 'Wellmade Motors And Development Corp-North'
            ],
        ];
    
        foreach ($machine_purchase_from as $key => $value) {
            MachinePurchaseFrom::insert([
            
                'machine_purchase_from_name' => $value['machine_purchase_from_name'],
            ]);
        }
    }
}
