<?php

namespace App\Http\Livewire\Report;

use App\Enums\ServiceInvoice;
use App\Enums\Status;
use App\Enums\TransactionStatus;
use App\Models\JobOrder;
use App\Models\TransactionSummary;
use App\Models\WorkOrder;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Livewire\Component;

class WeeklyRevenueGeneratedWithDeductionTable extends Component
{
    public $start_date, $end_date;

    public function addGenerate() {
        $this->emit('openModal');
    }
    public function printPdf() {
        $transaction_summarry = TransactionSummary::with('jobOrder.WorkOrders')
        ->where('transaction_type_id', ServiceInvoice::SERVICE_INVOICE)
        ->where('transaction_status_id', TransactionStatus::POSTED)
        ->whereNotNull('invoice_type_id')
        ->whereIn('status_id', [Status::PAID, Status::UNPAID])
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('date','>=',  Carbon::parse($this->start_date))
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        },function($query) {
            $query->whereMonth('date','=', Carbon::now());
        })
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->date)->format('Y-m-d');
        });

       
        $pdf  = PDF::loadView('livewire.prints.weekly-revenue-generated-with-deduction', [ 
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'transaction_summarry' => $transaction_summarry  
        ])->setPaper('A4','landscape')->output(); 

        return response()->streamDownload(
            fn () => print($pdf),"weekly-revenue-generated-with-deduction.pdf"
        );     
    }
    public function render()
    {
       
        $transaction_summarry = TransactionSummary::with('jobOrder.WorkOrders')
        ->where('transaction_type_id', ServiceInvoice::SERVICE_INVOICE) //2
        ->where('transaction_status_id', TransactionStatus::POSTED)     //2
        ->whereNotNull('invoice_type_id')
        ->whereIn('status_id', [Status::PAID, Status::UNPAID])
        ->when($this->start_date && $this->end_date, function ($query) {
            $query->where('date','>=',  Carbon::parse($this->start_date))
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59));
        },function($query) {
            $query->whereMonth('date','=', Carbon::now());
        })
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->date)->format('Y-m-d');
        });
       
        return view('livewire.report.weekly-revenue-generated-with-deduction-table',[
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'transaction_summarry' => $transaction_summarry
        ]);
    }
}
