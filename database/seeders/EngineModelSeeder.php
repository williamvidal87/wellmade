<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EngineModel;

class EngineModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            
            [
                'model' => '1661',
                'year_made_id' => 101,
                'make_id' => 1,
                'category_id' => 2,
                'cylinder_id' => 1,
                'valve_id' => 1,
            ],
            [
                'model' => 'IS2',
                'year_made_id' => 1,
                'make_id' => 1,
                'category_id' => 5,
                'cylinder_id' => 3,
                'valve_id' => 4,
            ],
            [
                'model' => 'X5',
                'year_made_id' => 101,
                'make_id' => 2,
                'category_id' => 1,
                'cylinder_id' => 3,
                'valve_id' => 1,
            ],
            [
                'model' => '10HP',
                'year_made_id' => 101,
                'make_id' => 3,
                'category_id' => 1,
                'cylinder_id' => 3,
                'valve_id' => 4,
            ],
            [
                'model' => '600',
                'year_made_id' => 105,
                'make_id' => 2,
                'category_id' => 2,
                'cylinder_id' => 3,
                'valve_id' => 1,
            ],
        ];
    
        EngineModel::insert($list);
    }
}
