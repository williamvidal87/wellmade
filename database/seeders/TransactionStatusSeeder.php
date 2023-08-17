<?php

namespace Database\Seeders;

use App\Models\TransactionStatus;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionStatus = [
            [
                'name' => 'Setup',
            ],
            [
                'name' => 'Posted',
            ],
            [
                'name' => 'Reversed',
            ],
        ];

        foreach ($transactionStatus as $key => $value) {
            TransactionStatus::insert([
                'name' => $value['name'],
            ]);
        }
    }
}
