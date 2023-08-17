<?php

namespace App\Http\Livewire\Inventory;

use Livewire\Component;
use App\Models\StockManagement;
use App\Models\InventoryType;
use App\Exports\InventoryReportListing;
use App\Models\LoanConsumeStatus;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\WithPagination;


class InventoryReportListingTable extends Component
{
    use WithPagination;

    public $consume_status,$inventory_type_id, $start_date, $end_date;   
    public $filter_quantity;
    public $qty=0;
   

   
    public function addGenerate()
    {
      $this->emit('openModal');      
    }

    public function printPdf()
    {         
        $loan_consumable = LoanConsumeStatus::all();   
        $this->loan_consumables = $loan_consumable;   //not implemented
        $qty             = $this->qty;
        $filter_qty      = $this->filter_quantity;
        $consumable      = $this->consume_status;
        $inventory_typ   = $this->inventory_type_id; 
        $date_start      = $this->start_date;  
        $date_end        = $this->end_date;
          
        $report_data = StockManagement::where(function($query) use ($qty, $filter_qty, $consumable, $inventory_typ, $date_start, $date_end){

            if($filter_qty == 1) {        
                $query->where('qty', '<=', $qty);
            }
            if($filter_qty == 2) {
                $query->where('qty', '>=', $qty);
            }
            if($filter_qty == 3) {
                $query->where('qty', '=', $qty);
            }
            if($consumable) {
                $query->where('loan_consume_ids', $consumable);
            }
            if($inventory_typ) {
                $query->where('inventory_type_id', $inventory_typ);
            }                                           
            if($date_start && $date_end) {
                $query->where('created_at', '>=',$date_start)
                        ->where('created_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
            }
        })->get();      
              

        $pdf  = PDF::loadView('livewire.prints.inventory-report-listing', ['report_data' => $report_data, 'loanConsumable'   => $this->loan_consumables,])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"inventory-report-listing.pdf"
        );     
    } 
    
    public function printExcel()
    {                 
        return Excel::download(new InventoryReportListing($this->consume_status,$this->inventory_type_id, $this->start_date, $this->end_date, $this->filter_quantity, $this->qty), 'InventoryReportListing.xlsx');     
    }

    public function render()
    {              

        // dd($this->qty);
        $qty             = $this->qty;
        $filter_qty      = $this->filter_quantity;
        $consumable      = $this->consume_status;
        $inventory_typ   = $this->inventory_type_id;        
        $date_start      = $this->start_date;  
        $date_end        = $this->end_date;
       
            
        $report_data = StockManagement::where(function($query) use ($filter_qty, $qty, $consumable, $inventory_typ, $date_start, $date_end){

            if($filter_qty == 1) {        
                $query->where('qty', '<=', $qty);
            }
            if($filter_qty == 2) {
                $query->where('qty', '>=', $qty);
            }
            if($filter_qty == 3) {
                $query->where('qty', '=', $qty);
            }
            if($consumable) {
                $query->where('loan_consume_ids', $consumable);
            }
            if($inventory_typ) {
                $query->where('inventory_type_id', $inventory_typ);
            }
            if($date_start && $date_end) {
                $query->where('created_at', '>=',$date_start)
                        ->where('created_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
            }                               
        })->get();      
        // dd($report_data);
        $inventory_types = InventoryType::all();       
        $loan_consumable = LoanConsumeStatus::all();                         
                                
        $this->loan_consumables = $loan_consumable;   
        $this->consume          = $consumable;                      
        $this->inventory       = $report_data;   //model
        $this->inventory_t     = $inventory_types;        
        $this->current_type    = $inventory_typ;
        $this->date_started    = $date_start;
        $this->date_ended      = $date_end;
       
        // $start_strip = strpos($this->consume,"0;");
        // $end_strip = strpos($this->consume, ";}");

        // $string_remove = stripos($start_strip, $end_strip, $this->consume);

    //    dd($this->loan_consumables);

        return view('livewire.inventory.inventory-report-listing-table',[
            'loanConsumable'   => $this->loan_consumables,   //not implemented
            'currentConsumeStatus'    => $this->consume,
            'inventory_report' => $this->inventory,
            'inventory_type'   => $this->inventory_t,          
            'current_types'    => $this->current_type,
            'start_d'          => $this->date_started,
            'end_d'            => $this->date_ended,         

          
        ]);
    }
}
