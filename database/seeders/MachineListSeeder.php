<?php

namespace Database\Seeders;

use App\Models\Machines;
use Illuminate\Database\Seeder;

class MachineListSeeder extends Seeder
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
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Angle Grinder - Universal - General Repair [ 115-211-501-Y214-1AMP-BSH ]',
			],
			[   
				'job_type_id'                       =>  1,
				'machine_name'                      => 'Cutting - Horizontal - Power Hacksaw [ 306-300-506-Y213-nc-SCU ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Drilling - Vertical - Drill Press [ 102-101-501-Y217-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Grinding - Universal - Bench Grinder [ 200-211-501-Y213-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Lathe - Horizontal - Lathe Machine [ 100-100-501-Y213-nc-STO ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Lathe - Horizontal - Lathe Machine [ 100-100-501-Y213-nc-TSG ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Lathe - Horizontal - Lathe Machine [ 100-100-501-Y213-nc-TTM ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Milling - Horizontal - Milling [ 101-100-501-Y217-nc-VTR ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Presser - Vertical - Presser [ 113-101-501-Y213-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Presser - Vertical - Presser [ 113-101,??-501-Y213-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Torch Cutting - Oxy/Gas/Aceytelene - Oxy-Gasul [ 302-307-501-Y217-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Welding - SMAW - Welding Machine(SMAW) [ 301-304-501-Y213-nc-OKK ]',
			],
            [   
                'job_type_id'                       =>  1,
				'machine_name'                      => 'Welding - TIG - TIG Welding Machine [ 301-306-501-Y213-nc-cPH ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Air Compressor - Universal - Compressor [ 307-102-502-Y213-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Boring, Electrical - Conrod Assy - Conrod Resizer [ 106-207-502-Y217-nc-OKK ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Boring, Horizontal - Universal - Line Boring Machine [ 202-211-502-Y213-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Boring, Vertical - Vertical - Boring [ 201-301-502-Y217-nc-cPH ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Cap Honing - Conrod Assy - CONROD HONING [112-207-502-Y213-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Grinding - Crankshaft - Crankshaft Grinder [ 200-200-506-Y217-nc-SCU ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Grinding - Head & Block - Surface Grinder [ 200-206-502-Y217-1000000TON-JAP ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Grinding - Head & Block - Surface Grinder [ 200-206-502-Y217-nc-HLR ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Honing, Vertical - Blocks - Honing [ 203-205-502-Y213-nc-KKW ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Refacing & Resetting - Valves Seats - Valve Refacer [ 204-202-502-Y213-nc-BAD ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Resizer - Conrod Assy - Conrod Resizer [ 309-207-502-Y217-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Valve Seat - Head - Valve Seat [ 110-204-502-Y213-nc-CHN ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Valve Seat - Head - Valve Seat [ 110-204-502-Y213-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  2,
				'machine_name'                      => 'Washing - Universal - Pressure Washer [ 11-102-502-Y213-nc-NB ]',
			],
            [   
                'job_type_id'                       =>  3,
				'machine_name'                      => 'Calibrating - Injection Pump - Calibration machine [ 205-209-502-Y213-nc-BSH ]',
			],
            [   
                'job_type_id'                       =>  3,
				'machine_name'                      => 'Calibrating - Injectors -Nozzle Tester [ 205-210-502-Y217-nc-BSH ]',
			],
        ];
        
        foreach ($machinelist as $key => $value) {

            Machines::insert([
                'job_type_id'               =>$value['job_type_id'],
                'machine_name'              =>$value['machine_name'],
           ]);
		}
    }
}
