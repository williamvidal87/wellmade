<?php

namespace Database\Seeders;

use App\Models\Percent;
use Illuminate\Database\Seeder;

class PercentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $percent_name[0]=[
                'percent_number' => 0,
                'percent_name' => '0%',
                ];
        for ($i = 1; $i <= 100; $i++) {
            $percent_name[$i] =
            [   
                'percent_number' => $i,
                'percent_name' => $i.'%',
            ];
        }
        foreach ($percent_name as $key => $value) {
            Percent::insert([
                'percent_number' => $value['percent_number'],
                'percent_name' => $value['percent_name'],
            ]);
		}
    }
}
