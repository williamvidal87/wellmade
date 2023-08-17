<?php

namespace Database\Seeders;

use App\Models\MachinePurchaseType;
use Illuminate\Database\Seeder;

class MachinePurchaseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine_purchase_type = [
            [
                'machine_purchase_type_name' => 'CNF (Cost and Freight)'
            ],
            [
                'machine_purchase_type_name' => 'CIF (Cost Insurance Freight)'
            ],
           
        ];
        foreach ($machine_purchase_type as $key => $value) {
            MachinePurchaseType::insert([
            
                'machine_purchase_type_name' => $value['machine_purchase_type_name'],
            ]);
        }
    }
}
