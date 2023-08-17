<?php

namespace Database\Seeders;

use App\Models\Scopes;
use Illuminate\Database\Seeder;

class ERScopeSeeder extends Seeder
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
                'er_work_group_id' => 3,
                'scope_name' => 'Grinding to perfect round - main',
                'unit_id' => 4,
            ],
            [
                'er_work_group_id' => 3,
                'scope_name' => 'Grinding to perfect round - conrod',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 3,
                'scope_name' => 'Build-up and Grind oil Seal Seat',
                'unit_id' => 4,
            ],
            [
                'er_work_group_id' => 3,
                'scope_name' => 'Straightening $ Journals to mirror finish',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 3,
                'scope_name' => 'Sandings of Journal to mirror finish',
                'unit_id' => 4,
            ],
            [
                'er_work_group_id' => 3,
                'scope_name' => 'Crack testing of Journals',
                'unit_id' => null,
            ],
            [
                'er_work_group_id' => 4,
                'scope_name' => 'Resleeving or reboring',
                'unit_id' => 2,
            ],
            [
                'er_work_group_id' => 4,
                'scope_name' => 'Crack Testing (wet process)',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 4,
                'scope_name' => 'Line bore housing to crankshaft',
                'unit_id' => 3,
            ],
            [
                'er_work_group_id' => 4,
                'scope_name' => 'Fitting of housing to crankshaft',
                'unit_id' => 2,
            ],
            [
                'er_work_group_id' => 4,
                'scope_name' => 'Camshaft bushing replace',
                'unit_id' => 5,
            ],
            [
                'er_work_group_id' => 4,
                'scope_name' => 'Build-up of main housing',
                'unit_id' => null,
            ],
            [
                'er_work_group_id' => 4,
                'scope_name' => 'Machine Liner',
                'unit_id' => 2,
            ],
            [
                'er_work_group_id' => 4,
                'scope_name' => 'Build-up T-Washer',
                'unit_id' => null,
            ],
            [
                'er_work_group_id' => 5,
                'scope_name' => 'Piston Pin Bushing Replace',
                'unit_id' => 5,
            ],
            [
                'er_work_group_id' => 5,
                'scope_name' => 'Grinding boring & restandard',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 5,
                'scope_name' => 'Fitting of housing C/ Journals',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 5,
                'scope_name' => 'Conversion of conrod arm',
                'unit_id' => 5,
            ],
            [
                'er_work_group_id' => 5,
                'scope_name' => 'Machine Piston',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 5,
                'scope_name' => 'Press Fit Piston',
                'unit_id' => null,
            ],
            [
                'er_work_group_id' => 6,
                'scope_name' => 'Surface Grind to mirror finish',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 6,
                'scope_name' => 'Fabricatopn of valve seat ring',
                'unit_id' => 5,
            ],
            [
                'er_work_group_id' => 6,
                'scope_name' => 'V-Seat Ring Replace & Setting',
                'unit_id' => 5,
            ],
            [
                'er_work_group_id' => 6,
                'scope_name' => 'V-Seat Ring Replace & Settings',
                'unit_id' => 5,
            ],
            [
                'er_work_group_id' => 6,
                'scope_name' => 'Valve Cutting & Refacing',
                'unit_id' => null,
            ],
            [
                'er_work_group_id' => 6,
                'scope_name' => 'Valve Guide Replace & Honing',
                'unit_id' => 5,
            ],
            [
                'er_work_group_id' => 6,
                'scope_name' => 'Crack and Pressure Testing',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 6,
                'scope_name' => 'LOCK-N-STICTH CRACK REPAIR',
                'unit_id' => null,
            ],
            [
                'er_work_group_id' => 7,
                'scope_name' => 'Turbo Wash',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 7,
                'scope_name' => 'Steam Wash',
                'unit_id' => 1,
            ],
            [
                'er_work_group_id' => 7,
                'scope_name' => 'Descaling',
                'unit_id' => 1,
            ],
        ];
        foreach ($list as $key => $value) {
            Scopes::insert([
                'er_work_group_id'          => $value['er_work_group_id'],
                'scope_name'                => $value['scope_name'],
                'unit_id'                   => $value['unit_id'],
            ]);
		}
    }
}
