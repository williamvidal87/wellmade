<?php

namespace App\Http\Livewire\Report;

use App\Enums\JobType;
use App\Models\AddWorker;
use App\Models\Holiday;
use App\Models\JobTypes;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\YearMade;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use Spatie\Permission\Models\Role;

class OperatorMonthlyefficiencyReportTable extends Component
{
    public $worker_id, $start_date, $end_date, $work_type_id;

    public function addGenerate()
    {
        $this->emit('openModal');
    }
    
    public function printPdf() 
    {
        $worker = User::whereHas('roles', function ($query) {
            $query->where('name', 'Operator');
        })->get();  


        $show_user = User::whereHas('roles', function ($query) {
            $query->where('name', ['Admin','Super Admin']);
        })->get(); 


        $holidays = Holiday::whereYear('date', Carbon::now()->year)->get();
    
         //workdays base in start
        $total_workdays = AddWorker::with('getWorkOrder') 
        ->whereIn('status',[9,5])     
        ->when($this->worker_id, function ($query) {
            $query->where('assigned_worker_id', '=', $this->worker_id);
        })
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('start', '>=', $this->start_date)
            ->where('end', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })
        // ->when($this->start_date, function ($query) {
        //     $query->where('start', '>=', $this->start_date);
        // })
     
        // ->where(function ($query) {
        //     $query->where('end', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
        //     ->orwhere('end','=', null);
        // })
        ->get()
        ->groupBy(function($data) {
            return Carbon::parse($data->start)->format('Y-m-d');
        });
       

        $work_order = WorkOrder::where('status', 9)->with('getWorker','getJobOrder','getScope','getJobType')
        ->when($this->worker_id, function ($query) {              
            $query->whereHas('getWorker', function ($q) {
                $q->where('assigned_worker_id' ,$this->worker_id);
        })->get();
        }) 
        ->when($this->work_type_id, function ($query) {                
            $query->where('job_type_id', $this->work_type_id);                
        })           
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->whereHas('getJobOrder', function ($q) {
                $q->where('date', '>=', $this->start_date)
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })->get();                    
        },function($query) {
            $query->whereHas('getJobOrder', function($q){
                $q->whereMonth('date','=', Carbon::now());
            });          
        })
        ->get();

        //count workOrder
        $total_dept_wo = WorkOrder::where('status', 9)->with('getWorker','getJobOrder','getScope','getJobType')
        ->when($this->work_type_id && $this->start_date && $this->end_date, function ($counts) {
            $counts->where('job_type_id', $this->work_type_id)
                    ->where('created_at', '>=', $this->start_date)
                    ->where('created_at', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })->get();


        $total_emp_commit = 0;
        foreach($total_dept_wo as $key => $get_total_dept_commit1) {
            foreach($get_total_dept_commit1->getWorker as $get_total_dept_commit) {
               
                $total_emp_commit += $get_total_dept_commit->allot_hours;
            }           
        }
      
        $counter = count($work_order);
        $total_dept_wo = count($total_dept_wo);      

        $current_workers = $this->worker_id;
        $current_month = $this->start_date;
        $current_year = $this->end_date;
        $current_work_type = $this->work_type_id;

        $pdf  = PDF::loadView('livewire.prints.montly-operator-efficiency-report', [ 
            'holidays' => $holidays,
            'total_workdays' => $total_workdays,
            'work_order' => $work_order, 
            'current_workers' =>  $current_workers,   
            'start_d' => $current_month,
            "end_d" => $current_year,
            'current_work_type' => $current_work_type,
            'worker' => $worker,    
            'show_user' => $show_user,  
            'work_type' => JobTypes::all(),    
            'counter' => $counter,
            'total_dept_wo' => $total_dept_wo, 
            'total_emp_commit' => $total_emp_commit
            
        ])->output(); 

        return response()->streamDownload(
            fn () => print($pdf),"monthly-operator-efficieny-report.pdf"
        );     
    }
    public function render()
    { 
   
        $worker = User::whereHas('roles', function ($query) {
            $query->where('name', 'Operator');
        })->get();  


        $show_user = User::whereHas('roles', function ($query) {
            $query->where('name', ['Admin','Super Admin']);
        })->get(); 


        $holidays = Holiday::whereYear('date', Carbon::now()->year)->get();
    
         //workdays base in start
        $total_workdays = AddWorker::with('getWorkOrder') 
        ->whereIn('status',[9,5])     
        ->when($this->worker_id, function ($query) {
            $query->where('assigned_worker_id', '=', $this->worker_id);
        })
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('start', '>=', $this->start_date)
            ->where('end', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })
        // ->when($this->start_date, function ($query) {
        //     $query->where('start', '>=', $this->start_date);
        // })
     
        // ->where(function ($query) {
        //     $query->where('end', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
        //     ->orwhere('end','=', null);
        // })
        ->get()
        ->groupBy(function($data) {
            return Carbon::parse($data->start)->format('Y-m-d');
        });
       

        $work_order = WorkOrder::where('status', 9)->with('getWorker','getJobOrder','getScope','getJobType')
        ->when($this->worker_id, function ($query) {              
            $query->whereHas('getWorker', function ($q) {
                $q->where('assigned_worker_id' ,$this->worker_id);
        })->get();
        }) 
        ->when($this->work_type_id, function ($query) {                
            $query->where('job_type_id', $this->work_type_id);                
        })           
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->whereHas('getJobOrder', function ($q) {
                $q->where('date', '>=', $this->start_date)
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })->get();                    
        },function($query) {
            $query->whereHas('getJobOrder', function($q){
                $q->whereMonth('date','=', Carbon::now());
            });          
        })
        ->get();

        //count workOrder
        $total_dept_wo = WorkOrder::where('status', 9)->with('getWorker','getJobOrder','getScope','getJobType')
        ->when($this->work_type_id && $this->start_date && $this->end_date, function ($counts) {
            $counts->where('job_type_id', $this->work_type_id)
                    ->where('created_at', '>=', $this->start_date)
                    ->where('created_at', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })->get();


        $total_emp_commit = 0;
        foreach($total_dept_wo as $key => $get_total_dept_commit1) {
            foreach($get_total_dept_commit1->getWorker as $get_total_dept_commit) {
               
                $total_emp_commit += $get_total_dept_commit->allot_hours;
            }           
        }
      
        $counter = count($work_order);
        $total_dept_wo = count($total_dept_wo);      

        $current_workers = $this->worker_id;
        $current_month = $this->start_date;
        $current_year = $this->end_date;
        $current_work_type = $this->work_type_id;
        return view('livewire.report.operator-monthly-efficiency-report-table', [
            'holidays' => $holidays,
            'total_workdays' => $total_workdays,
            'work_order' => $work_order, 
            'current_workers' =>  $current_workers,   
            'start_d' => $current_month,
            "end_d" => $current_year,
            'current_work_type' => $current_work_type,          
            'worker' => $worker,             //operator  
            'show_user' => $show_user,      
            'work_type' => JobTypes::all(),    
            'counter' => $counter,
            'total_dept_wo' => $total_dept_wo, 
            'total_emp_commit' => $total_emp_commit

        ]);

    }
}
