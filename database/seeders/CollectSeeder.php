<?php

namespace Database\Seeders;

use App\Models\Collect;
use Illuminate\Database\Seeder;

class CollectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collect = [
			[
				'type' => 'Operation',
			],
            [
				'type' => 'Finance',
			],
            
        ];
        
        foreach ($collect as $key => $value) {
            Collect::insert([
                'type' => $value['type'],
            ]);
		}
    }
}
