<?php

namespace App\Exports;

use App\Models\DailyConsumeReport;
use App\Models\JobOrder;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutosize;

class WorkOrderExport implements FromView ,ShouldAutosize
{  

public $jobStatus;
public $workType;
public $startDate;
public $endDate;

public function __construct($jobStatus, $workType, $startDate, $endDate)
{
    $this->jobStatus = $jobStatus;
    $this->workType = $workType;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
}

public function view(): View {
    // $total_all=0;
    $total_off=0;
    $total_er=0;
    $total_mf=0;
    $job_order = DailyConsumeReport::when($this->jobStatus, function($query) {
                                    $query->where('status', $this->jobStatus);
                                })
                                ->when($this->workType, function($query) {
                                    $query->where('job_type_id', $this->workType);
                                })                              
                                ->when($this->startDate && $this->endDate, function($query) {
                                    $query->where('created_at', '>=',$this->startDate)
                                        ->where('created_at', '<=', Carbon::parse($this->endDate)->addHour(23)->addMinute(59)->addSecond(59));                                                                    
                                },function($query) {
                                    $query->whereDate('created_at','=', Carbon::today());
                                })->get();    

                                
    foreach($job_order as $all_totals) {     
        if($all_totals->getDepartment->id == 6) { 
            $total_off+=$all_totals->total;
        }
        if($all_totals->getDepartment->id == 2) {
            $total_er+=$all_totals->total;
        }
        if($all_totals->getDepartment->id == 4) {
            $total_mf+=$all_totals->total;
        }
    }      
    
    // $total_off=0;
    // $total_er=0;
    // $total_mf=0;
    // $job_order = DailyConsumeReport::where(function($query) use ($job_status, $work_typ, $date_start, $date_end){            

    //                             // if($job_status) {
    //                             //     $query->where('status', $job_status);
    //                             // } 
    //                             if($work_typ) {
    //                                 $query->where('department_id', $work_typ);
    //                             }
    //                             if($date_start && $date_end) {
    //                                 $query->where('created_at', '>=',$date_start)
    //                                       ->where('created_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
    //                             }
                                                            
    //                     })->get();         
                        
    

    return view('layouts.exports.job-report-listing',[
        'daily_consume' => $job_order,
        // 'allTotals'      => $total_all
        'totalOff'        =>$total_off,
        'totalEr'         =>$total_er,
        'totalMf'         =>$total_mf,

    ]);
}


}
