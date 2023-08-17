<?php

namespace Database\Seeders;

use App\Models\YearMade;
use Illuminate\Database\Seeder;

class YearMadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 1900;
        $yearmades[0]=[
                'year_made' => '0',
                ];
        for ($i = 1; $i <= 201; $i++) {
            $total = $count+$i;
            $yearmades[$i] =
            [
                'year_made' => $total,
            ];
        }
        foreach ($yearmades as $key => $value) {
            YearMade::insert([
                'year_made' => $value['year_made'],
            ]);
		}
    }
}
