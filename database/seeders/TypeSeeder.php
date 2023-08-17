<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $type =[
            [
                'type' => 'Gas',
            ],
            [
                'type' => 'Diesel',
            ],
        ];
        
        foreach ($type as $key => $value) {
            Type::insert([
                'type' => $value['type'],
            ]);
		}
    }
}
