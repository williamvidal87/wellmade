<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
			[

				'status' 			=> 'Pending',
			],
			[
				'status' 			=> 'Approved',
			],
            [
				'status' 			=> 'Cancelled',
			],
            [
				'status' 			=> 'Processing',
			],
            [
				'status' 			=> 'Doing',
			],
            [
				'status' 			=> 'For approval',
			],
            [
				'status' 			=> 'Re-work',
			],
            [
				'status' 			=> 'To-Released',
			],
            [
				'status' 			=> 'Done',
			],
            [
				'status' 			=> 'Yes',
			],
            [
				'status' 			=> 'No',
			],
            [
				'status' 			=> 'Paid',
			],
            [
				'status' 			=> 'Unpaid',
			],
            [
				'status' 			=> 'Active',
			],
            [
				'status' 			=> 'Inactive',
			],
            
        ];
        
        foreach ($statuses as $key => $value) {

            Status::insert([
                'status' => $value['status'],
            ]);
		}
    }
}
