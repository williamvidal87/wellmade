<?php

namespace Database\Seeders;

use App\Models\Valve;
use Illuminate\Database\Seeder;

class ValveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Valve = [
			[

				'valve' 			=> '0',
			],
			[

				'valve' 			=> '2',
			],
			[
				'valve' 			=> '6',
			],
            [
				'valve' 			=> '8',
			],
            [
				'valve' 			=> '10',
			],
            [
				'valve' 			=> '12',
			],
            [
				'valve' 			=> '16',
			],
            [
				'valve' 			=> '20',
			],
            [
				'valve' 			=> '24',
			],
            [
				'valve' 			=> '32',
			],
            
        ];
        
        foreach ($Valve as $key => $value) {

            Valve::insert([
                'valve' => $value['valve'],
            ]);
		}
    }
}
