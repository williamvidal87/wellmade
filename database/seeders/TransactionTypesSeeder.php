<?php

namespace Database\Seeders;

use App\Models\TransactionTypes;
use Illuminate\Database\Seeder;

class TransactionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionTypes = [
            [
                'transaction_type' => 'Receipts Payments',
            ],
            [
                'transaction_type' => 'Service Invoice',
            ],
        ];

        foreach ($transactionTypes as $key => $value) {
            TransactionTypes::insert([
                'transaction_type' => $value['transaction_type'],
            ]);
        }
    }
}
