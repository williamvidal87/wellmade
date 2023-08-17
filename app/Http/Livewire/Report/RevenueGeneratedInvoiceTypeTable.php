<?php

namespace App\Http\Livewire\Report;

use App\Enums\ServiceInvoice;
use App\Enums\Status;
use App\Enums\TransactionStatus;
use App\Models\TransactionSummary;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;

class RevenueGeneratedInvoiceTypeTable extends Component
{
    public $start_date, $end_date, $revenue_generated_invoice_type, $invoice_type;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'filter_date',
    ];

    public function filter_date($start_date, $end_date, $invoice_type)
    {
        if(!empty($start_date) && !empty($end_date)){

            //SB
            if($invoice_type == 1){
                $this->revenue_generated_invoice_type = TransactionSummary::with('jobOrder.clientProfile.forCSA', 'jobOrder.WorkOrders')
                ->whereIn('transaction_status_id', [2])
                ->whereIn('status_id', [12,13])
                ->where('invoice_type_id', 1)
                ->where('date', '>=', Carbon::parse($this->start_date))
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
                ->get();

            //WV
            }elseif($invoice_type == 2){
                $this->revenue_generated_invoice_type = TransactionSummary::with('jobOrder.clientProfile.forCSA', 'jobOrder.WorkOrders')
                ->whereIn('transaction_status_id', [2])
                ->whereIn('status_id', [12,13])
                ->where('invoice_type_id', 2)
                ->where('date', '>=', Carbon::parse($this->start_date))
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
                ->get();

            // WV & SB
            }else{
                $this->revenue_generated_invoice_type = TransactionSummary::with('jobOrder.clientProfile.forCSA', 'jobOrder.WorkOrders')
                ->whereIn('transaction_status_id', [2])
                ->whereIn('status_id', [12,13])
                ->whereIn('invoice_type_id', [1,2])
                ->where('date', '>=', Carbon::parse($this->start_date))
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
                ->get();
            }

            $this->invoice_type = $invoice_type;
            $this->start_date = $start_date;
            $this->end_date = $end_date;
        }

    }

    public function mount()
    {
        $this->start_date = Carbon::now()->startOfMonth()->toDateString();
        $this->end_date = Carbon::now()->endOfMonth()->toDateString();
        $this->invoice_type = 3; //WV & SB by default

        $this->revenue_generated_invoice_type = TransactionSummary::with('jobOrder.clientProfile.forCSA', 'jobOrder.WorkOrders')
        ->whereIn('transaction_status_id', [2])
        ->whereIn('status_id', [12,13])
        ->whereIn('invoice_type_id', [1,2])
        ->where('date', '>=', Carbon::parse($this->start_date))
        ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
        ->get();
    }

    public function addGenerate()
    {
        $this->emit('openRevenueGeneratedInvoiceTypeModal');
    }

    public function printPdf()
    {
        //SB
        if($this->invoice_type == 1){
            $this->revenue_generated_invoice_type = TransactionSummary::with('jobOrder.clientProfile.forCSA', 'jobOrder.WorkOrders')
            ->whereIn('transaction_status_id', [2])
            ->whereIn('status_id', [12,13])
            ->where('invoice_type_id', 1)
            ->where('date', '>=', Carbon::parse($this->start_date))
            ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
            ->get();

        //WV
        }elseif($this->invoice_type == 2){
            $this->revenue_generated_invoice_type = TransactionSummary::with('jobOrder.clientProfile.forCSA', 'jobOrder.WorkOrders')
            ->whereIn('transaction_status_id', [2])
            ->whereIn('status_id', [12,13])
            ->where('invoice_type_id', 2)
            ->where('date', '>=', Carbon::parse($this->start_date))
            ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
            ->get();

        // WV & SB
        }else{
            $this->revenue_generated_invoice_type = TransactionSummary::with('jobOrder.clientProfile.forCSA', 'jobOrder.WorkOrders')
            ->whereIn('transaction_status_id', [2])
            ->whereIn('status_id', [12,13])
            ->whereIn('invoice_type_id', [1,2])
            ->where('date', '>=', Carbon::parse($this->start_date))
            ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
            ->get();
        }

        $pdf  = PDF::loadView('livewire.prints.revenue-generated-invoice-type-report', ['revenue_generated_invoices' => $this->revenue_generated_invoice_type, 'start_date' => $this->start_date, 'end_date' => $this->end_date])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"revenue-generated-invoice-type-report.pdf"
        );
    }

    public function render()
    {
        return view('livewire.report.revenue-generated-invoice-type-table', [
                'revenue_generated_invoices' => $this->revenue_generated_invoice_type,
                'start_date' => $this->start_date,
                'end_date'  => $this->end_date,
        ]);
    }
}
