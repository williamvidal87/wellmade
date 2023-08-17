<?php

namespace App\Http\Livewire\Inventory;

use App\Models\RequestTool;
use App\Models\RequestToolData;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;

class DailyMaintenanceReportTable extends Component
{
    public $end_date,$start_date;

    public function addGenerate()
    {
        $this->emit('openModal');
    }

    public function printPdf()
    {
        if($this->end_date == null){
            $end_d = now()->format('Y-m-d');           
            $this->end_date = $end_d;
        }else{           
            $end_d = $this->end_date;
        }  
        
        $maintenance = RequestToolData::with('getRequestTool.getJobOrder', 'getStockManagment.getDepartment','getRequestTool.getRequestBy')
        ->whereRelation('getRequestTool','status_id',2)          //approved
        ->whereRelation('getStockManagment','department_id',3)   //maintenance
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('created_at', '>=', Carbon::parse($this->start_date))
                ->where('created_at', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })
        ->get();

        $pdf  = PDF::loadView('livewire.prints.daily-maintenance-report', [ 
            'maintenance' => $maintenance, 
            'end_d' => $end_d
        ])->output(); 

        return response()->streamDownload(
            fn () => print($pdf),"daily-maintenance-report.pdf"
        );     
           
    }

    public function render()
    {
        if($this->end_date == null){
            $end_d = now()->format('Y-m-d');           
            $this->end_date = $end_d;
        }else{           
            $end_d = $this->end_date;
        }  
        
        $maintenance = RequestToolData::with('getRequestTool.getJobOrder', 'getStockManagment.getDepartment','getRequestTool.getRequestBy')
        ->whereRelation('getRequestTool','status_id',2)          //approved
        ->whereRelation('getStockManagment','department_id',3)   //maintenance
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('created_at', '>=', Carbon::parse($this->start_date))
                ->where('created_at', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })
        ->get();
   
       
        return view('livewire.inventory.daily-maintenance-report-table',[
            'maintenance' => $maintenance,
            'end_d' => $end_d
        ]);
    }
}
