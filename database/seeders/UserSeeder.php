<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Admin',
            'address' => 'Everywhere',
            'contact_no' => '0912345678',
            'emergency_contact_person' => 'Test',
            'emergency_contact_address' => 'Test Addr',
            'emergency_contact_no' => '0912345678',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ];

        User::create($user);
    }
}
