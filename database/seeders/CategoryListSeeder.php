<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryList;

class CategoryListSeeder extends Seeder
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
                'category' => 'A',
                'type_id'  => 1
            ],
            [    
                'category' => 'B',
                'type_id'  => 1
            ],
            [    
                'category' => 'C',
                'type_id'  => 1
            ],
            [    
                'category' => 'D',
                'type_id'  => 2
            ],
            [    
                'category' => 'E',
                'type_id'  => 1
            ],
            [    
                'category' => 'F',
                'type_id'  => 2
            ],
            [    
                'category' => 'G',
                'type_id'  => 2
            ],
            [    
                'category' => 'H',
                'type_id'  => 2
            ],
            [    
                'category' => 'I',
                'type_id'  => 2
            ],
            [    
                'category' => 'J',
                'type_id'  => 2
            ],
        ];
    
        CategoryList::insert($list);
    }
}
