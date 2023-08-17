<?php

namespace App\Http\Livewire\Inventory;

use App\Models\RequestTool;
use App\Models\RequestToolData;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DailyShopSuppliesReportTable extends Component
{
    public $shop_supplies;
    public $start_date, $end_date;

    public function addGenerate()
    {
        $this->emit('openModal');
    }

    public function printPdf()
    {
         // $request_tool = RequestTool::where('status_id',2)->get();

        // foreach($request_tool as $loanable) {
        //     $this->shop_supplies = unserialize($loanable->request_type);
        // }
        if($this->end_date == null){
            $end_d = now()->format('Y-m-d');           
            $this->end_date = $end_d;
        }else{           
            $end_d = $this->end_date;
        }  

        $request_tool_data = RequestToolData::with('getRequestTool.getJobOrder', 'getStockManagment.getDepartment')
        ->whereRelation('getRequestTool','status_id',2)
        ->whereRelation('getRequestTool','request_type','a:1:{i:0;s:1:"3";}',str_contains('a:1:{i:0;s:1:"3";}',3))
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('created_at', '>=', Carbon::parse($this->start_date))
                ->where('created_at', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })
        ->get()
        ->groupBy('getRequestTool.getJobOrder.jo_no');     

        $pdf  = PDF::loadView('livewire.prints.daily-shop-supplies-report', [ 
            'request_tool_data' => $request_tool_data, 
            'end_d' => $end_d
        ])->output(); 

        return response()->streamDownload(
            fn () => print($pdf),"daily-shop-supplies-report.pdf"
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
        
        $request_tool_data = RequestToolData::with('getRequestTool.getJobOrder', 'getStockManagment.getDepartment')
        ->whereRelation('getRequestTool','status_id',2)
        ->whereRelation('getRequestTool','request_type','a:1:{i:0;s:1:"3";}',str_contains('a:1:{i:0;s:1:"3";}',3))
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('created_at', '>=', Carbon::parse($this->start_date))
                ->where('created_at', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        })
        ->get()
        ->groupBy('getRequestTool.getJobOrder.jo_no');      

        return view('livewire.inventory.daily-shop-supplies-report-table',[
            'request_tool_data' => $request_tool_data,
            'end_d' => $end_d
            
        ]);
    }
}
