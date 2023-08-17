<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientType;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clienttypes = [
			[
				'industry_id' => 1,
				'client_type' => 'Freelance Mechanic',
			],
            [
				'industry_id' => 2,
				'client_type' => 'Repair Shop / Service Center',
			],
            [
				'industry_id' => 3,
				'client_type' => 'Transport (Taxi/Bus/Jeepney)',
			],
            [
				'industry_id' => 4,
				'client_type' => 'Trucking / Hauling (Heavy Equipments)',
			],
            [
				'industry_id' => 5,
				'client_type' => 'Industrial / Manufacturing / Mining',
			],
            [
				'industry_id' => 6,
				'client_type' => 'Power Plants',
			],
            [
				'industry_id' => 7,
				'client_type' => 'Marine / Shipping',
			],
            [
				'industry_id' => 8,
				'client_type' => 'MEPZ Companies',
			],
            [
				'industry_id' => 9,
				'client_type' => 'Logistics',
			],
            [
				'industry_id' => 10,
				'client_type' => 'Constructions',
			],
            [
				'industry_id' => 11,
				'client_type' => 'Miscellaneous',
			],
            
        ];
        
        foreach ($clienttypes as $key => $value) {
            ClientType::insert([
				'industry_id' => $value['industry_id'],
                'client_type' => $value['client_type'],
            ]);
		}
    }
}
