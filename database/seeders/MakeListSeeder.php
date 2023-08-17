<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MakeList;

class MakeListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makelist = [
            [
                'make_name' => 'Aircooled Diesel'
            ],
            [
                'make_name' => 'Airplane'
            ],
            [
                'make_name' => 'ASTRA'
            ],
            [
                'make_name' => 'Audi'
            ],
            [
                'make_name' => 'BMW'
            ],
            [
                'make_name' => 'BRIGGS & STRATON'
            ],
            [
                'make_name' => 'Cama'
            ],
            [
                'make_name' => 'Caterpillar'
            ],
            [
                'make_name' => 'Cav'
            ],
            [
                'make_name' => 'Chander'
            ],
            [
                'make_name' => 'CHERRY'
            ],
            [
                'make_name' => 'Chevrolet'
            ],
            [
                'make_name' => 'CHINA'
            ],
            [
                'make_name' => 'CHRYSLER'
            ],
            [
                'make_name' => 'Compressor'
            ],
            [
                'make_name' => 'Cummins'
            ],
            [
                'make_name' => 'DAEWOO'
            ],
            [
                'make_name' => 'DAIDEN'
            ],
            [
                'make_name' => 'DAIHATSU'
            ],
            [
                'make_name' => 'DAISIN'
            ],
            [
                'make_name' => 'DENYO'
            ],
            [
                'make_name' => 'DETROIT'
            ],
            [
                'make_name' => 'DEUTZ'
            ],
            [
                'make_name' => 'DODGE'
            ],
            [
                'make_name' => 'Dongfeng'
            ],
            [
                'make_name' => 'Dongfeng'
            ],
            [
                'make_name' => 'EME'
            ],
            [
                'make_name' => 'FIAT'
            ],
            [
                'make_name' => 'FORD'
            ],
        ];
    
        MakeList::insert($makelist);
    }
}
