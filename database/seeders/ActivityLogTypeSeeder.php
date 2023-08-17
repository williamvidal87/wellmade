<?php

namespace Database\Seeders;

use App\Models\ActivityLogType;
use Illuminate\Database\Seeder;

class ActivityLogTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
			[
				'type' => 'User Log',
			],
            [
				'type' => 'Payment Log',
			],
            [
				'type' => 'Contact Incentives Log',
			],
            [
				'type' => 'User Incentives Log',
			],
        ];
        
        ActivityLogType::insert($data);
    }
}
