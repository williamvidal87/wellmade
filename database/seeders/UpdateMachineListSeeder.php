<?php

namespace Database\Seeders;

use App\Models\Machines;
use Illuminate\Database\Seeder;

class UpdateMachineListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
        $machinelist = [
			[   
				'id'                                =>  1,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Angle Grinder - Universal - General Repair [ 115-211-501-Y214-1AMP-BSH ]',
				'machine_description_id'            =>  12,
				'machine_group_id'                  =>  49,
				'machine_sub_group_id'              =>  74,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2014-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  28,
			],
			[   
				'id'                                =>  2,
				'job_type_id'                       =>  1,
				'machine_name'                      => 'Cutting - Horizontal - Power Hacksaw [ 306-300-506-Y213-nc-SCU ]',
				'machine_description_id'            =>  19,
				'machine_group_id'                  =>  15,
				'machine_sub_group_id'              =>  25,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  214,
			],
            [   
				'id'                                =>  3,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Drilling - Vertical - Drill Press [ 102-101-501-Y217-nc-NB ]',
				'machine_description_id'            =>  10,
				'machine_group_id'                  =>  13,
				'machine_sub_group_id'              =>  22,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  4,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Grinding - Universal - Bench Grinder [ 200-211-501-Y213-nc-NB ]',
				'machine_description_id'            =>  2,
				'machine_group_id'                  =>  4,
				'machine_sub_group_id'              =>  7,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  5,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Lathe - Horizontal - Lathe Machine [ 100-100-501-Y213-nc-STO ]',
				'machine_description_id'            =>  14,
				'machine_group_id'                  =>  6,
				'machine_sub_group_id'              =>  9,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  212,
			],
            [   
				'id'                                =>  6,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Lathe - Horizontal - Lathe Machine [ 100-100-501-Y213-nc-TSG ]',
				'machine_description_id'            =>  14,
				'machine_group_id'                  =>  6,
				'machine_sub_group_id'              =>  9,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  236,
			],
            [   
				'id'                                =>  7,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Lathe - Horizontal - Lathe Machine [ 100-100-501-Y213-nc-TTM ]',
				'machine_description_id'            =>  14,
				'machine_group_id'                  =>  6,
				'machine_sub_group_id'              =>  9,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  242,
			],
            [   
				'id'                                =>  8,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Milling - Horizontal - Milling [ 101-100-501-Y217-nc-VTR ]',
				'machine_description_id'            =>  16,
				'machine_group_id'                  =>  10,
				'machine_sub_group_id'              =>  16,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  262,
			],
            [   
				'id'                                =>  9,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Presser - Vertical - Presser [ 113-101-501-Y213-nc-NB ]',
				'machine_description_id'            =>  20,
				'machine_group_id'                  =>  7,
				'machine_sub_group_id'              =>  11,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  10,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Presser - Vertical - Presser [ 113-101,??-501-Y213-nc-NB ]',
				'machine_description_id'            =>  20,
				'machine_group_id'                  =>  7,
				'machine_sub_group_id'              =>  11,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  11,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Torch Cutting - Oxy/Gas/Aceytelene - Oxy-Gasul [ 302-307-501-Y217-nc-NB ]',
				'machine_description_id'            =>  18,
				'machine_group_id'                  =>  43,
				'machine_sub_group_id'              =>  67,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  12,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Welding - SMAW - Welding Machine(SMAW) [ 301-304-501-Y213-nc-OKK ]',
				'machine_description_id'            =>  27,
				'machine_group_id'                  =>  8,
				'machine_sub_group_id'              =>  12,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  189,
			],
            [   
				'id'                                =>  13,
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Welding - TIG - TIG Welding Machine [ 301-306-501-Y213-nc-cPH ]',
				'machine_description_id'            =>  23,
				'machine_group_id'                  =>  8,
				'machine_sub_group_id'              =>  14,
				'machine_dept_location_id'          =>  7,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  196,
			],
            [   
				'id'                                =>  14,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Air Compressor - Universal - Compressor [ 307-102-502-Y213-nc-NB ]',
				'machine_description_id'            =>  5,
				'machine_group_id'                  =>  5,
				'machine_sub_group_id'              =>  8,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  15,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Boring, Electrical - Conrod Assy - Conrod Resizer [ 106-207-502-Y217-nc-OKK ]',
				'machine_description_id'            =>  7,
				'machine_group_id'                  =>  51,
				'machine_sub_group_id'              =>  76,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  189,
			],
            [   
				'id'                                =>  16,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Boring, Horizontal - Universal - Line Boring Machine [ 202-211-502-Y213-nc-NB ]',
				'machine_description_id'            =>  15,
				'machine_group_id'                  =>  40,
				'machine_sub_group_id'              =>  60,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  17,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Boring, Vertical - Vertical - Boring [ 201-301-502-Y217-nc-cPH ]',
				'machine_description_id'            =>  3,
				'machine_group_id'                  =>  39,
				'machine_sub_group_id'              =>  57,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  196,
			],
            [   
				'id'                                =>  18,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Cap Honing - Conrod Assy - CONROD HONING [112-207-502-Y213-nc-NB ]',
				'machine_description_id'            =>  6,
				'machine_group_id'                  =>  28,
				'machine_sub_group_id'              =>  43,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  19,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Grinding - Crankshaft - Crankshaft Grinder [ 200-200-506-Y217-nc-SCU ]',
				'machine_description_id'            =>  8,
				'machine_group_id'                  =>  4,
				'machine_sub_group_id'              =>  4,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  214,
			],
            [   
				'id'                                =>  20,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Grinding - Head & Block - Surface Grinder [ 200-206-502-Y217-1000000TON-JAP ]',
				'machine_description_id'            =>  22,
				'machine_group_id'                  =>  4,
				'machine_sub_group_id'              =>  5,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  1000000,
				'machine_unit_id'                   =>  8,
				'machine_brand_id'                  =>  122,
			],
            [   
				'id'                                =>  21,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Grinding - Head & Block - Surface Grinder [ 200-206-502-Y217-nc-HLR ]',
				'machine_description_id'            =>  22,
				'machine_group_id'                  =>  4,
				'machine_sub_group_id'              =>  5,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  97,
			],
            [   
				'id'                                =>  22,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Honing, Vertical - Blocks - Honing [ 203-205-502-Y213-nc-KKW ]',
				'machine_description_id'            =>  13,
				'machine_group_id'                  =>  3,
				'machine_sub_group_id'              =>  3,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  139,
			],
            [   
				'id'                                =>  23,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Refacing & Resetting - Valves Seats - Valve Refacer [ 204-202-502-Y213-nc-BAD ]',
				'machine_description_id'            =>  25,
				'machine_group_id'                  =>  41,
				'machine_sub_group_id'              =>  61,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  25,
			],
            [   
				'id'                                =>  24,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Resizer - Conrod Assy - Conrod Resizer [ 309-207-502-Y217-nc-NB ]',
				'machine_description_id'            =>  7,
				'machine_group_id'                  =>  48,
				'machine_sub_group_id'              =>  77,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  25,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Valve Seat - Head - Valve Seat [ 110-204-502-Y213-nc-CHN ]',
				'machine_description_id'            =>  26,
				'machine_group_id'                  =>  1,
				'machine_sub_group_id'              =>  1,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  36,
			],
            [   
				'id'                                =>  26,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Valve Seat - Head - Valve Seat [ 110-204-502-Y213-nc-NB ]',
				'machine_description_id'            =>  26,
				'machine_group_id'                  =>  1,
				'machine_sub_group_id'              =>  1,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  27,
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Washing - Universal - Pressure Washer [ 11-102-502-Y213-nc-NB ]',
				'machine_description_id'            =>  21,
				'machine_group_id'                  =>  23,
				'machine_sub_group_id'              =>  36,
				'machine_dept_location_id'          =>  4,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  null,
			],
            [   
				'id'                                =>  28,
                'job_type_id'                       =>  3,
				'machine_name'                      => 'Calibrating - Injection Pump - Calibration machine [ 205-209-502-Y213-nc-BSH ]',
				'machine_description_id'            =>  4,
				'machine_group_id'                  =>  32,
				'machine_sub_group_id'              =>  47,
				'machine_dept_location_id'          =>  3,
				'arrival_date'                      =>  '2013-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  28,
			],
            [   
				'id'                                =>  29,
                'job_type_id'                       =>  3,
				'machine_name'                      => 'Calibrating - Injectors -Nozzle Tester [ 205-210-502-Y217-nc-BSH ]',
				'machine_description_id'            =>  17,
				'machine_group_id'                  =>  32,
				'machine_sub_group_id'              =>  48,
				'machine_dept_location_id'          =>  3,
				'arrival_date'                      =>  '2017-01-01',
				'capacity'                          =>  null,
				'machine_unit_id'                   =>  null,
				'machine_brand_id'                  =>  28,
			],
        ];
        
        foreach ($machinelist as $key => $value) {

            Machines::find($value['id'])->update([
                'job_type_id'               =>$value['job_type_id'],
                'machine_name'              =>$value['machine_name'],
                'machine_description_id'    =>$value['machine_description_id'],
                'machine_group_id'          =>$value['machine_group_id'],
                'machine_sub_group_id'      =>$value['machine_sub_group_id'],
                'machine_dept_location_id'  =>$value['machine_dept_location_id'],
                'arrival_date'              =>$value['arrival_date'],
                'capacity'                  =>$value['capacity'],
                'machine_unit_id'           =>$value['machine_unit_id'],
                'machine_brand_id'          =>$value['machine_brand_id'],
           ]);
		}
    }
}