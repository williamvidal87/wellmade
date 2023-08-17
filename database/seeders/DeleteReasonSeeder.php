<?php

namespace Database\Seeders;

use App\Models\DeleteReason;
use Illuminate\Database\Seeder;

class DeleteReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $deletereason =
            [
                [
                'reason' => 'Double Encoded',
                ],
                [
                'reason' => 'Expensive Price',
                ],
                [
                'reason' => 'Incapable Machines',
                ],
                [
                'reason' => 'Item is Rejected',
                ],
                [
                'reason' => 'Mis-Encoded (Dept, Assign)',
                ],
                [
                'reason' => 'No Spare Parts Available',
                ],
                [
                'reason' => 'Not Recomended by the customer',
                ],
            ];
        foreach ($deletereason as $key => $value) {
            DeleteReason::insert([
                'reason' => $value['reason'],
            ]);
		}
    }
}
