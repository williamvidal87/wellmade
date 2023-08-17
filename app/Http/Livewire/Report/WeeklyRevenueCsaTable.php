<?php

namespace App\Http\Livewire\Report;

use App\Enums\ServiceInvoice;
use App\Enums\Status;
use App\Enums\TransactionStatus;
use App\Models\CsaType;
use App\Models\JobOrder;
use App\Models\TransactionSummary;
use App\Service\IncentiveService;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Livewire\Component;

class WeeklyRevenueCsaTable extends Component
{
    public $start_date, $end_date, $customer;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'filter_date',
    ];

    public function mount()
    {
        $this->start_date = Carbon::now()->startOfMonth()->toDateString();
        $this->end_date = Carbon::now()->endOfMonth()->toDateString();
        $this->customer = TransactionSummary::with('jobOrder.WorkOrders', 'jobOrder.clientProfile.forCSA')
            ->where('transaction_type_id', ServiceInvoice::SERVICE_INVOICE)
            ->where('transaction_status_id', TransactionStatus::POSTED)
            ->whereNotNull('invoice_type_id')
            ->whereIn('status_id', [Status::PAID, Status::UNPAID])
            ->where('date', '>=', Carbon::parse($this->start_date))
            ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
            ->get()
            ->sortBy('date')
            ->groupBy(function($date) {
                return Carbon::parse($date->date)->format('Y-m-d');
            })
            ->toArray();
    }

    public function addGenerate()
    {
        $this->emit('openWeeklyRevenueCsaModal');
    }

    public function filter_date($start_date, $end_date)
    {
        if(!empty($start_date) && !empty($end_date)){
            $this->start_date = $start_date;
            $this->end_date = $end_date;
            $this->customer = TransactionSummary::with('jobOrder.WorkOrders', 'jobOrder.clientProfile.forCSA')
                ->where('transaction_type_id', ServiceInvoice::SERVICE_INVOICE)
                ->where('transaction_status_id', TransactionStatus::POSTED)
                ->whereNotNull('invoice_type_id')
                ->whereIn('status_id', [Status::PAID, Status::UNPAID])
                ->where('date', '>=', Carbon::parse($this->start_date))
                ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
                ->get()
                ->sortBy('date')
                ->groupBy(function($date) {
                    return Carbon::parse($date->date)->format('Y-m-d');
                })
                ->toArray();
            
        }
    }

    public function printPdf()
    {
        $report_data = TransactionSummary::with('jobOrder.WorkOrders', 'jobOrder.clientProfile.forCSA')
            ->where('transaction_type_id', ServiceInvoice::SERVICE_INVOICE)
            ->where('transaction_status_id', TransactionStatus::POSTED)
            ->whereNotNull('invoice_type_id')
            ->whereIn('status_id', [Status::PAID, Status::UNPAID])
            ->where('date', '>=', Carbon::parse($this->start_date))
            ->where('date', '<=', Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59))
            ->get()
            ->sortBy('date')
            ->groupBy(function($date) {
                return Carbon::parse($date->date)->format('Y-m-d');
            })
            ->toArray();
        
        $pdf  = PDF::loadView('livewire.prints.weekly-revenue-by-csa', ['report_data' => $report_data, 'start_date' => $this->start_date, 'end_date' => $this->end_date, 'csa_types' => CsaType::all()])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"weekly-revenue-by-csa.pdf"
        );
    }

    public function render(IncentiveService $incentiveService)
    {

        // $job_orders = JobOrder::whereNotNull('total_incentive')
        //     ->whereNotNull('contact_person')
        //     ->get();

        // foreach ($job_orders as $job_order) {
            
        //     $incentive = $incentiveService->calculateIncentive($job_order->id);

        //     JobOrder::where('id', $job_order->id)->update([
        //         'total_incentive' => $incentive
        //     ]);

        // }
        // dd("ASD");

        return view('livewire.report.weekly-revenue-csa-table', [
            'revenue_csa' => $this->customer,
            'csa_types' => CsaType::all(),
        ]);
    }
}
