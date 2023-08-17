<?php

namespace Database\Seeders;

use App\Models\LoanConsumeStatus;
use Illuminate\Database\Seeder;

class LoanConsumeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loanConsumeStatus = [
			[
				'name' 			=> 'Consumable',
			],
            [
				'name' 			=> 'Loanable',
			],
            [
				'name' 			=> 'Shop Supplies',
			],
            [
				'name' 			=> 'Measuring Equip',
			],
            [
				'name' 			=> 'Spare Parts',
			],
            [
				'name' 			=> 'Transportation',
			],
            [
				'name' 			=> 'Mach. & Equip',
			],
            [
				'name' 			=> 'Office Equip',
			],
            [
				'name' 			=> 'Office/Building',
			],
            [
				'name' 			=> 'Assigned',
			],
            
        ];
        
        foreach ($loanConsumeStatus as $key => $value) {
            LoanConsumeStatus::insert([
                'name' => $value['name'],
            ]);
		}
    }
}
