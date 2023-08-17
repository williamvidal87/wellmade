<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = [
			[

				'branch_name' => 'Dumaguete',
			],
            
        ];
        
        foreach ($branch as $key => $value) {
            Branch::insert([
                'branch_name' => $value['branch_name'],
            ]);
		}
    }
}
