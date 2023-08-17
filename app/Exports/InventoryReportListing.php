<?php

namespace App\Exports;

use App\Models\LoanConsumeStatus;
use App\Models\StockManagement;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutosize;

class InventoryReportListing implements FromView ,ShouldAutosize
{
    public $consume_status, $inventory_type_id, $startDate, $endDate;
    public $filter_quantity;
    public $qty=0;

    public function __construct($consume_status,$inventory_type_id, $startDate, $endDate, $filter_quantity, $qty)
    {   
        $this->$consume_status   = $consume_status;
        $this->inventory_type_id = $inventory_type_id;  
        $this->startDate         = $startDate;
        $this->endDate           = $endDate;
        $this->filter_quantity   = $filter_quantity;
        $this->qty              = $qty;
       
    }
  
    public function view(): View {
       
        $loan_consumable = LoanConsumeStatus::all();   
        $this->loan_consumables = $loan_consumable;    //not implemented
    
        $inventory_report_list = StockManagement::when($this->filter_quantity, function ($query) {
                                                    if($this->filter_quantity == 1) {
                                                        $query->where('qty', '<=', $this->qty);
                                                    }
                                                    if($this->filter_quantity == 2) {
                                                        $query->where('qty', '>=', $this->qty);
                                                    }
                                                    if($this->filter_quantity == 3) {
                                                        $query->where('qty','=', $this->qty);
                                                    }
                                                })
                                                ->when($this->consume_status, function($query) {
                                                    $query->where('loan_consume_status_id',$this->consume_status);
                                                   })
                                                 ->when($this->inventory_type_id, function($query) {
                                                    $query->where('inventory_type_id', $this->inventory_type_id);
                                                    })                                                
                                                ->when($this->startDate && $this->endDate, function($query) {
                                                    $query->where('created_at', '>=',$this->startDate)
                                                        ->where('created_at', '<=', Carbon::parse($this->endDate)->addHour(23)->addMinute(59)->addSecond(59));
                                                    })
                                                ->get();           
    
        return view('layouts.exports.inventory-report-listing',[
            'inventory_report_list' => $inventory_report_list,
            'loanConsumable'   => $this->loan_consumables,
        ]);
    }
}
