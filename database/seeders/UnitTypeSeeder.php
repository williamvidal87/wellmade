<?php

namespace Database\Seeders;

use App\Models\UnitType;
use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
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
                'description'       => 'bag',
				'longdescription'   => 'Bag',
			],
            [
                'description'       => 'bar',
				'longdescription'   => 'Bar',
			],
            [
                'description'       => 'bdl',
				'longdescription' 	=> 'Bundle',
			],
            [
                'description'       => 'bks',
				'longdescription' 	=> 'Books',
			],
            [
                'description'       => 'bkt',
				'longdescription' 	=> 'Bucket',
			],
            [
                'description'       => 'box',
				'longdescription' 	=> 'Box',
			],
            [
                'description'       => 'brl',
				'longdescription' 	=> 'Barrel',
			],
            [
                'description'       => 'btl',
				'longdescription' 	=> 'Bottle',
			],
            [
                'description'       => 'can',
				'longdescription' 	=> 'Can',
			],
            [
                'description'       => 'case',
				'longdescription' 	=> 'Case',
			],
            [
                'description'       => 'ccm',
				'longdescription' 	=> 'Cubic Centimeter',
			],
            [
                'description'       => 'cg',
				'longdescription' 	=> 'Centigrams',
			],
            [
                'description'       => 'chn',
				'longdescription' 	=> 'Chain',
			],
            [
                'description'       => 'crt',
				'longdescription' 	=> 'Crate',
			],
            [
                'description'       => 'ctn',
				'longdescription' 	=> 'Carton',
			],
            [
                'description'       => 'deck',
				'longdescription' 	=> 'Deck',
			],
            [
                'description'       => 'dose',
				'longdescription' 	=> 'Dose',
			],
            [
                'description'       => 'dozen',
				'longdescription' 	=> 'Dozen',
			],
            [
                'description'       => 'ft',
				'longdescription' 	=> 'Feet',
			],
            [
                'description'       => 'gal',
				'longdescription' 	=> 'Gallon',
			],
            [
                'description'       => 'gram',
				'longdescription' 	=> 'Gram',
			],
            [
                'description'       => 'jar',
				'longdescription' 	=> 'Jar',
			],
            [
                'description'       => 'kit',
				'longdescription' 	=> 'Kit',
			],
            [
                'description'       => 'klg',
				'longdescription' 	=> 'Kilogram Weight',
			],
            [
                'description'       => 'lbs',
				'longdescription' 	=> 'Pound',
			],
            [
                'description'       => 'liter',
				'longdescription' 	=> 'Liter Size',
			],
            [
                'description'       => 'm',
				'longdescription' 	=> 'Meter Length',
			],
            [
                'description'       => 'pad',
				'longdescription' 	=> 'Pad',
			],
            [
                'description'       => 'pair',
				'longdescription' 	=> 'Pair',
			],
            [
                'description'       => 'pallet',
				'longdescription' 	=> 'Pallet',
			],
            [
                'description'       => 'pc(s)',
				'longdescription' 	=> 'Pieces',
			],
            [
                'description'       => 'pkg',
				'longdescription' 	=> 'Package',
			],
            [
                'description'       => 'ream',
				'longdescription' 	=> 'Ream',
			],
            [
                'description'       => 'rnd',
				'longdescription' 	=> 'Round',
			],
            [
                'description'       => 'rol',
				'longdescription' 	=> 'Roll',
			],
            [
                'description'       => 'set',
				'longdescription' 	=> 'Set',
			],
            [
                'description'       => 'sm',
				'longdescription' 	=> 'Square Meter',
			],
            [
                'description'       => 'sqf',
				'longdescription' 	=> 'Square Foot',
			],
            [
                'description'       => 'terabytes',
				'longdescription' 	=> 'Terabytes',
			],
            [
                'description'       => 'ton',
				'longdescription' 	=> 'Ton',
			],
            [
                'description'       => 'unit',
				'longdescription' 	=> 'Unit',
			],
            [
                'description'       => 'vial',
				'longdescription' 	=> 'Vial',
			],
            [
                'description'       => 'yard',
				'longdescription' 	=> 'Yard',
			],
        ];
        
        UnitType::insert($list);
    }
}
