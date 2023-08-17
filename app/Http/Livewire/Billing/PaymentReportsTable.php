<?php

namespace App\Http\Livewire\Billing;

use App\Models\TransactionSummary;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\Component;

class PaymentReportsTable extends Component
{

    public $month, $payment_reports, $invoice_type;
    public $mn = null;
    public $yr = null;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'filter_date',
    ];

    public function mount()
    {
        $this->invoice_type = 3; // means WB & SB
        $this->mn = Carbon::now()->month;
        $this->yr = Carbon::now()->year;
        $this->payment_reports = TransactionSummary::with('jobOrder.clientProfile.forCSA')
            ->whereIn('transaction_status_id', [2])
            ->whereIn('status_id', [12,13])
            ->whereIn('invoice_type_id', [1,2])
            ->whereMonth('date', $this->mn)
            ->whereYear('date', $this->yr)
            ->get();
    }

    public function addGenerate()
    {
        $this->emit('resetInputFields');
        $this->emit('openPaymentReportModal');
    }

    public function filter_date($month, $invoice_type)
    {
        
        if(!empty($month) && !empty($invoice_type)){
            $this->month = $month;
            $this->invoice_type = $invoice_type;
            $month = explode("-", $this->month)[1];
            $year = explode("-", $this->month)[0];
            $this->mn = $month;
            $this->yr = $year;
            if($this->invoice_type == 1){
                $this->payment_reports = TransactionSummary::with('jobOrder.clientProfile.forCSA')
                    ->whereIn('transaction_status_id', [2])
                    ->whereIn('status_id', [12,13])
                    ->whereIn('invoice_type_id', [1])
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->get();
            }elseif ($this->invoice_type == 2){
                $this->payment_reports = TransactionSummary::with('jobOrder.clientProfile.forCSA')
                    ->whereIn('transaction_status_id', [2])
                    ->whereIn('status_id', [12,13])
                    ->whereIn('invoice_type_id', [2])
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->get();
            }else{
                $this->payment_reports = TransactionSummary::with('jobOrder.clientProfile.forCSA')
                    ->whereIn('transaction_status_id', [2])
                    ->whereIn('status_id', [12,13])
                    ->whereIn('invoice_type_id', [1,2])
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->get();
            }
            
        }
    }

    public function printPdf()
    {
        if($this->invoice_type == 1){
            $report_data = TransactionSummary::with('jobOrder.clientProfile.forCSA')
                ->whereIn('transaction_status_id', [2])
                ->whereIn('status_id', [12,13])
                ->whereIn('invoice_type_id', [1])
                ->whereMonth('date', $this->mn)
                ->whereYear('date', $this->yr)
                ->get();
        }elseif ($this->invoice_type == 2){
            $report_data = TransactionSummary::with('jobOrder.clientProfile.forCSA')
                ->whereIn('transaction_status_id', [2])
                ->whereIn('status_id', [12,13])
                ->whereIn('invoice_type_id', [2])
                ->whereMonth('date', $this->mn)
                ->whereYear('date', $this->yr)
                ->get();
        }else{
            $report_data = TransactionSummary::with('jobOrder.clientProfile.forCSA')
                ->whereIn('transaction_status_id', [2])
                ->whereIn('status_id', [12,13])
                ->whereIn('invoice_type_id', [1,2])
                ->whereMonth('date', $this->mn)
                ->whereYear('date', $this->yr)
                ->get();
        }
        
        $pdf  = PDF::loadView('livewire.prints.payment-report', ['report_data' => $report_data, 'invoice_types' => $this->invoice_type, 'mn' => $this->mn, 'yr' => $this->yr])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"payment-report.pdf"
        );
    }

    public function render()
    {
        return view('livewire.billing.payment-reports-table', [
            'payment_reports' => $this->payment_reports,
        ]);
    }
}
