<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
			[

				'name' 			=> 'Super Admin',
				'guard_name' 	=> 'web',
			],
			[
				'name' 			=> 'Admin',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'Teller',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'Clerk',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'Accountant',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'Supervisor',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'Operator',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'Encoder',
                'guard_name' 	=> 'web',
			],
            [
				'name' 			=> 'Salesman',
                'guard_name' 	=> 'web',
			],
            
        ];
        
        foreach ($roles as $key => $value) {

            Role::insert([
                'name' => $value['name'],
                'guard_name' => $value['guard_name'],
            ]);
		}
    }
}
