<?php

namespace Database\Seeders;

use App\Models\GeneralProcedure;
use Illuminate\Database\Seeder;

class GeneralProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generalprocedure = [
			
			[   
				'groups_id'                 => null,
                'work_sub_type_id'       => 26,
				'general_procedure_name' => 'Calibrate of Injector assemblies',
			],
            [   
                'groups_id'                 => null,
                'work_sub_type_id'       => 27,
				'general_procedure_name' => 'Callibrate of injection pump assembly',
			],
            
        ];
        
        foreach ($generalprocedure as $key => $value) {
            GeneralProcedure::insert([
                'groups_id'              => $value['groups_id'],
                'work_sub_type_id'       => $value['work_sub_type_id'],
                'general_procedure_name' => $value['general_procedure_name'],
            ]);
		}
    }
}
