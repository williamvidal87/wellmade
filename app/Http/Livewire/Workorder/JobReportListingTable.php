<?php

namespace App\Http\Livewire\Workorder;

use Livewire\Component;
use App\Models\Status;
use App\Models\JobOrder;
use App\Models\JobTypes;
use App\Exports\WorkOrderExport;
use App\Models\DailyConsumeReport;
use App\Models\Department;
use App\Models\RequestTool;
use App\Models\RequestToolData;
use App\Models\WorkArea;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\WithPagination;

class JobReportListingTable extends Component
{   
    use WithPagination;

    public $status, $job_type_id, $start_date, $end_date;  

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];
   
    public function openModalConsumable()
    {
        $this->emit('openConsumableModal');
    }

    public function addGenerate()
    {
        $this->emit('openModal');
    }
       
    public function printPdf()
    {    
        $request_tools = RequestTool::with('requestToolsData.getDepartment','getWorkArea')
        ->where('status_id',2)
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('date', '>=', Carbon::parse($this->start_date))
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        },function ($query) {
            $query->whereMonth('date', '=', now());
        })
        ->get();       

        // if($this->start_date == null && $this->end_date == null){
        //     $start = Carbon::now()->format('Y-m-d');
        //     $end = Carbon::now()->format('Y-m-d');
        //     $this->start_date = $start;
        //     $this->end_date = $end;
        // }else{
        //     $start = $this->start_date;
        //     $end = $this->end_date;
        // }  
        // if($this->start_date == null){
        //     $start = Carbon::now()->format('Y-m-d');
        //     $this->start_date = $start;
        // }else{
        //     $start = $this->start_date;
        // }
       
        // $job_status = $this->status;
        // $work_typ   = $this->job_type_id;   
        // $date_start = $this->start_date;  
        // $date_end   = $this->end_date;
        // $total_off=0;
        // $total_er=0;
        // $total_mf=0;
        // $report_data = DailyConsumeReport::where(function($query) use ($job_status, $work_typ, $date_start, $date_end){

        //     if($job_status) {
        //         $query->where('status', $job_status);
        //     } 
        //     if($work_typ) {
        //         $query->where('job_type_id', $work_typ);
        //     }
        //     if($date_start && $date_end) {
        //         $query->where('created_at', '>=',$date_start)
        //                 ->where('created_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
        //     }else{
        //         $query->whereDate('created_at','=', Carbon::today());
        //     }                                                                     
        // })->get();     

        // foreach($report_data as $all_totals) {     
        //     if($all_totals->getDepartment->id == 6) { 
        //         $total_off+=$all_totals->total;
        //     }
        //     if($all_totals->getDepartment->id == 2) {
        //         $total_er+=$all_totals->total;
        //     }
        //     if($all_totals->getDepartment->id == 4) {
        //         $total_mf+=$all_totals->total;
        //     }
        // }         

        $pdf  = PDF::loadView('livewire.prints.job-report-listing', [
            'request_tools' => $request_tools,
            'start_d'       => $this->start_date,
            'end_d'         => $this->end_date,
        ])  ->setPaper('A4','landscape')->output();      
        return response()->streamDownload(
            fn () => print($pdf),"daily-consume-report.pdf"
        );     
    }     
    
    public function printExcel()
    {                 
        return Excel::download(new WorkOrderExport($this->status, $this->job_type_id, $this->start_date, $this->end_date), 'DailyConsumeReport.xlsx');                   
        
    }

    public function render()
    {      
        $request_tools = RequestTool::with('requestToolsData.getDepartment','getWorkArea')
        ->where('status_id',2)
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('date', '>=', Carbon::parse($this->start_date))
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        },function ($query) {
            $query->whereMonth('date', '=', now());
        })
        ->get();       

        // if($this->start_date == null && $this->end_date == null){
        //     $start = Carbon::now()->format('Y-m-d');
        //     $end = Carbon::now()->format('Y-m-d');
        //     $this->start_date = $start;
        //     $this->end_date = $end;
        // }else{
        //     $start = $this->start_date;
        //     $end = $this->end_date;
        // }  

        // $job_status = $this->status;
        // $work_typ   = $this->job_type_id;   
        // $date_start = $this->start_date;  
        // $date_end   = $this->end_date;
      
        // // $total_off=0;
        // // $total_er=0;
        // // $total_mf=0;
        // $job_order = DailyConsumeReport::where(function($query) use ($job_status, $work_typ, $date_start, $date_end){            

        //         // if($job_status) {
        //         //     $query->where('status', $job_status);
        //         // } 
        //         if($work_typ) {
        //             $query->where('department_id', $work_typ);
        //         }
        //         if($date_start && $date_end) {
        //             $query->where('created_at', '>=',$date_start)
        //                     ->where('created_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
        //         }else{
        //             $query->whereDate('created_at','=', Carbon::today());
        //         }                                                                
        // })->get();         
                            
        // foreach($job_order as $all_totals) {     
        //     if($all_totals->getDepartment->id == 6) { 
        //         $total_off+=$all_totals->total;
        //     }
        //     if($all_totals->getDepartment->id == 2) {
        //         $total_er+=$all_totals->total;
        //     }
        //     if($all_totals->getDepartment->id == 4) {
        //         $total_mf+=$all_totals->total;
        //     }
        // }       

        // $statusess = Status::whereIn('id',[1,2,3,4,5,6,7,8,9])->get();
        // $work_area = Department::whereIn('id',[2,4,6])->get();  
         
        // $this->job_orders      = $job_order;   
        // $this->statuses        = $statusess;   
        // $this->job_statuses    = $job_status;  
        // $this->work_area       = $work_area;   
        // $this->current_type    = $work_typ;    
        // $this->date_started    = $date_start;
        // $this->date_ended      = $date_end;        
      
      
        return view('livewire.workorder.job-report-listing-table',[                    
            'request_tools'    => $request_tools,
            // 'daily_consume'    => $this->job_orders,
            // 'statuses'         => $this->statuses, 
            // 'current_status'   => $this->job_statuses,
            // 'work_type'        => $this->work_area,
            // 'current_type'     => $this->current_type,
            'start_d'          => $this->start_date,
            'end_d'            => $this->end_date,
           
            
        ]);
    }
}
