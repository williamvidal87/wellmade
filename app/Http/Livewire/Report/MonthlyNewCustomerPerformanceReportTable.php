<?php

namespace App\Http\Livewire\Report;

use App\Models\CsaType;
use App\Models\TransactionSummary;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade as PDF;

class MonthlyNewCustomerPerformanceReportTable extends Component
{

    public $date_one, $date_two, $today, $option_one_month, $option_one_year, $option_two_month, $option_two_year; 
    public $option_one = [];
    public $option_two = [];

    protected $listeners = [
        'refreshParent' => '$refresh',
        'filter_date',
    ];

    public function mount()
    {
        $this->today = Carbon::today();
        $this->date_one = Carbon::now()->format('M'). " - ". Carbon::now()->format('Y');
        $this->date_two = Carbon::now()->subMonth()->format('M'). " - ". Carbon::now()->format('Y');
        $this->option_one_month = Carbon::now()->format('m');
        $this->option_two_month = Carbon::now()->subMonth()->format('m');
        $this->option_one_year = Carbon::now()->format('Y');
        $this->option_two_year = Carbon::now()->format('Y');
    }

    public function printPdf()
    {

        $this->option_one = collect(TransactionSummary::with('jobOrder.clientProfile.clientTypes', 'jobOrder.clientProfile.forCSA')
            ->whereNotNull('invoice_type_id')
            ->whereIn('transaction_status_id', [2])
            ->whereIn('status_id', [12,13])
            ->whereYear('date', date('Y', strtotime($this->option_one_year)))
            ->whereMonth('date', $this->option_one_month)
            ->get()->groupBy('jobOrder.clientProfile.forCSA.csa_type'));

        $this->option_two = collect(TransactionSummary::with('jobOrder.clientProfile.clientTypes', 'jobOrder.clientProfile.forCSA')
            ->whereNotNull('invoice_type_id')
            ->whereIn('transaction_status_id', [2])
            ->whereIn('status_id', [12,13])
            ->whereYear('date', date('Y', strtotime($this->option_two_year)))
            ->whereMonth('date', $this->option_two_month)
            ->get()->groupBy('jobOrder.clientProfile.forCSA.csa_type'));

        $pdf  = PDF::loadView('livewire.prints.monthly-new-customer-performance-report', ['option_one' => $this->option_one, 'option_two' => $this->option_two, 'date_one' => $this->date_one, 'date_two' => $this->date_two, 'todayDate' => $this->today,'allCsa' => CsaType::all()])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"monthly-new-customer-performance.pdf"
        );
    }

    public function filter_date($option_one, $option_two)
    {
        if(!empty($option_one) && !empty($option_two)){
            $this->date_one = date('M', mktime(0, 0, 0, explode('-',$option_one)[1], 1)). " - ". explode('-',$option_one)[0]; 
            $this->date_two = date('M', mktime(0, 0, 0, explode('-',$option_two)[1], 1)). " - ". explode('-',$option_two)[0]; 
            $this->option_one_month = explode('-',$option_one)[1];
            $this->option_two_month = explode('-',$option_two)[1];
            $this->option_one_year = explode('-',$option_one)[0];
            $this->option_two_year = explode('-',$option_two)[0];
        }

    }

    public function addGenerate()
    {
        $this->emit('openMonthlyNewCustomerModal');
    }

    public function render()
    {
        $this->option_one = collect(TransactionSummary::with('jobOrder.clientProfile.clientTypes', 'jobOrder.clientProfile.forCSA')
            ->whereNotNull('invoice_type_id')
            ->whereIn('transaction_status_id', [2])
            ->whereIn('status_id', [12,13])
            ->whereYear('date', date('Y', strtotime($this->option_one_year)))
            ->whereMonth('date', $this->option_one_month)
            ->get()->groupBy('jobOrder.clientProfile.forCSA.csa_type'));

        $this->option_two = collect(TransactionSummary::with('jobOrder.clientProfile.clientTypes', 'jobOrder.clientProfile.forCSA')
            ->whereNotNull('invoice_type_id')
            ->whereIn('transaction_status_id', [2])
            ->whereIn('status_id', [12,13])
            ->whereYear('date', date('Y', strtotime($this->option_two_year)))
            ->whereMonth('date', $this->option_two_month)
            ->get()->groupBy('jobOrder.clientProfile.forCSA.csa_type'));

        return view('livewire.report.monthly-new-customer-performance-report-table', [
            'option_one' => $this->option_one,
            'option_two' => $this->option_two,
            'date_one' => $this->date_one,
            'date_two' => $this->date_two,
            'todayDate' => $this->today,
            'allCsa' => CsaType::all(),
        ]);
    }
}
