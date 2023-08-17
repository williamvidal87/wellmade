<?php

namespace App\Http\Livewire\Report;

use App\Enums\ServiceInvoice;
use App\Models\JobOrder;
use App\Models\TransactionParticular;
use App\Models\TransactionSummary;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;


class ReconciliationTable extends Component
{
    public $start_date;

    public function addGenerate()
    {
        $this->emit('openModal');
    }

    public function printPdf()
    {       

        if((date('l', strtotime($this->start_date)) == "Sunday")){
            $job_order = JobOrder::whereIn('payment_status_id', [5])
            ->whereIn('status', [1,2,3,4,9])
            ->when($this->start_date, function($query) {                               
                $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(1)->addHour(14)->addMinute(00)->addSecond(00));
                $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(14)->addMinute(00)->addSecond(00));
            })->with("getClient","getCSA", "WorkOrders")->get();

            $transaction_top_part = TransactionSummary::where('transaction_type_id', 2)
            ->where('transaction_status_id', 2)
            ->where('status_id', 3)
            ->whereHas('jobOrder', function ($query) {
                    return $query->where('overall_total', '!=', null);
                })
            ->when($this->start_date, function($query) {  
                $query->where('date', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                $query->where('date', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));                          
            })->with('jobOrder.getClient.forCSA', 'getPaymentType', 'getInvoiceType')->get()->groupBy('getInvoiceType.invoice_type');

            $transaction_particulars = TransactionParticular::whereHas('transactionSummaryReceipt', function ($query) {
                return $query->where('transaction_type_id', ServiceInvoice::RECEIPTS_PAYMENTS)
                    ->where('status_id', 1)
                    ->when($this->start_date, function($query) {                               
                        $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                        $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));
                        });
                    })->with("transactionSummaryReceipt.jobOrder.getClient.forCSA", 'transactionSummaryReceipt.getPaymentType', 'transactionSummaryReceipt.getCollect', "transactionSummaryInvoice.jobOrder.getClient.forCSA", 'transactionSummaryInvoice.getPaymentType', 'transactionSummaryInvoice.getCollect', 'transactionSummaryInvoice.getInvoiceType')->get()->groupBy('transactionSummaryInvoice.getInvoiceType.invoice_type');
        }elseif((date('l', strtotime($this->start_date)) == "Monday")){

            $job_order = JobOrder::whereIn('payment_status_id', [12, 13])
                ->whereIn('status', [1,2,3,4,9])
                ->when($this->start_date, function($query) {                               
                    $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                    $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(14)->addMinute(00)->addSecond(00));
            })->with("getClient","getCSA", "WorkOrders")->get();

            $transaction_top_part = TransactionSummary::where('transaction_type_id', 2)
            ->where('transaction_status_id', 2)
            ->where('status_id', 13)
            ->whereHas('jobOrder', function ($query) {
                    return $query->where('overall_total', '!=', null);
                })
            ->when($this->start_date, function($query) {  
                $query->where('date', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                $query->where('date', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));                          
            })->with('jobOrder.getClient.forCSA', 'getPaymentType', 'getInvoiceType')->get()->groupBy('getInvoiceType.invoice_type');

            $transaction_particulars = TransactionParticular::whereHas('transactionSummaryReceipt', function ($query) {
                return $query->where('transaction_type_id', ServiceInvoice::RECEIPTS_PAYMENTS)
                    ->where('status_id', 12)
                    ->when($this->start_date, function($query) {                               
                        $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                        $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));
                        });
                    })->with("transactionSummaryReceipt.jobOrder.getClient.forCSA", 'transactionSummaryReceipt.getPaymentType', 'transactionSummaryReceipt.getCollect', "transactionSummaryInvoice.jobOrder.getClient.forCSA", 'transactionSummaryInvoice.getPaymentType', 'transactionSummaryInvoice.getCollect', 'transactionSummaryInvoice.getInvoiceType')->get()->groupBy('transactionSummaryInvoice.getInvoiceType.invoice_type');
        }else{

            $job_order = JobOrder::whereIn('payment_status_id', [12, 13])
                ->whereIn('status', [1,2,3,4,9])
                ->when($this->start_date, function($query) {                               
                    $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(1)->addHour(14)->addMinute(00)->addSecond(00));
                    $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(14)->addMinute(00)->addSecond(00));
            })->with("getClient","getCSA", "WorkOrders")->get();

            $transaction_top_part = TransactionSummary::where('transaction_type_id', 2)
            ->where('transaction_status_id', 2)
            ->where('status_id', 13)
            ->whereHas('jobOrder', function ($query) {
                    return $query->where('overall_total', '!=', null);
                })
            ->when($this->start_date, function($query) {  
                $query->where('date', '>=',Carbon::parse($this->start_date)->subDays(1)->addHour(14)->addMinute(00)->addSecond(00));
                $query->where('date', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));                       
            })->with('jobOrder.getClient.forCSA', 'getPaymentType', 'getInvoiceType')->get()->groupBy('getInvoiceType.invoice_type');

            $transaction_particulars = TransactionParticular::whereHas('transactionSummaryReceipt', function ($query) {
                return $query->where('transaction_type_id', ServiceInvoice::RECEIPTS_PAYMENTS)
                    ->where('status_id', 12)
                    ->when($this->start_date, function($query) {                               
                        $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(1)->addHour(14)->addMinute(00)->addSecond(00));
                        $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));
                        });
                    })->with("transactionSummaryReceipt.jobOrder.getClient.forCSA", 'transactionSummaryReceipt.getPaymentType', 'transactionSummaryReceipt.getCollect', "transactionSummaryInvoice.jobOrder.getClient.forCSA", 'transactionSummaryInvoice.getPaymentType', 'transactionSummaryInvoice.getCollect', 'transactionSummaryInvoice.getInvoiceType')->get()->groupBy('transactionSummaryInvoice.getInvoiceType.invoice_type');
        }

        $job_order_pending = JobOrder::with("getClient","getCSA", "WorkOrders", 'getJobOrderTransaction')
        ->whereIn('status', [1,2,3,4])
        ->get();
        
        // $job_order_pending = JobOrder::where('payment_status_id', 13)
        //     ->whereIn('status', [1,2,3,4])->with("getClient","getCSA", "WorkOrders")->get();

        $start = $this->start_date;

        $pdf  = PDF::loadView('livewire.prints.reconciliation', ['job_order' => $job_order,'job_order_pending' => $job_order_pending,'start_d' => $start, 'transaction_particulars' => $transaction_particulars, 'transaction_top_part' => $transaction_top_part])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"reconciliation.pdf"
        );     
    }

    public function getWvInvoiceNo($id)
    {
        return TransactionSummary::where('jo_no', $id)->where('transaction_status_id', 3)->where('status_id', 3)->first();
    }

    public function mount()
    {
        $start = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        
        if($this->start_date == null){
            $start = Carbon::now()->format('Y-m-d');
            $this->start_date = $start;
        }else{
            $start = $this->start_date;
        }

        // Check here a separate condition to check if sunday, monday
        if((date('l', strtotime($this->start_date)) == "Sunday")){
            $job_order = JobOrder::whereIn('payment_status_id', [5])
            ->whereIn('status', [1,2,3,4,9])
            ->when($this->start_date, function($query) {                               
                $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));
            })->with("getClient","getCSA", "WorkOrders")->get();

            $transaction_top_part = TransactionSummary::where('transaction_type_id', 2)
            ->where('transaction_status_id', 2)
            ->where('status_id', 3)
            ->whereHas('jobOrder', function ($query) {
                    return $query->where('overall_total', '!=', null);
                })
            ->when($this->start_date, function($query) {  
                $query->where('date', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                $query->where('date', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));                          
            })->with('jobOrder.getClient.forCSA', 'getPaymentType', 'getInvoiceType')->get()->groupBy('getInvoiceType.invoice_type');

            $transaction_particulars = TransactionParticular::whereHas('transactionSummaryReceipt', function ($query) {
                return $query->where('transaction_type_id', ServiceInvoice::RECEIPTS_PAYMENTS)
                    ->where('status_id', 3)
                    ->when($this->start_date, function($query) {                               
                        $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                        $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));
                        });
                })->with("transactionSummaryReceipt.jobOrder.getClient.forCSA", 'transactionSummaryReceipt.getPaymentType', 'transactionSummaryReceipt.getCollect', "transactionSummaryInvoice.jobOrder.getClient.forCSA", 'transactionSummaryInvoice.getPaymentType', 'transactionSummaryInvoice.getCollect', 'transactionSummaryInvoice.getInvoiceType')->get()->groupBy('transactionSummaryInvoice.getInvoiceType.invoice_type');
        }elseif((date('l', strtotime($this->start_date)) == "Monday")){

            $job_order = JobOrder::whereIn('payment_status_id', [12, 13])
                ->whereIn('status', [1,2,3,4,9])
                ->when($this->start_date, function($query) {                               
                    $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                    $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));
            })->with("getClient","getCSA", "WorkOrders")->get();

            $transaction_top_part = TransactionSummary::where('transaction_type_id', 2)
            ->where('transaction_status_id', 2)
            ->where('status_id', 13)
            ->whereHas('jobOrder', function ($query) {
                    return $query->where('overall_total', '!=', null);
                })
            ->when($this->start_date, function($query) {  
                $query->where('date', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                $query->where('date', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));                          
            })->with('jobOrder.getClient.forCSA', 'getPaymentType', 'getInvoiceType')->get()->groupBy('getInvoiceType.invoice_type');

            $transaction_particulars = TransactionParticular::whereHas('transactionSummaryReceipt', function ($query) {
                return $query->where('transaction_type_id', ServiceInvoice::RECEIPTS_PAYMENTS)
                    ->where('status_id', 12)
                    ->when($this->start_date, function($query) {                               
                        $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(2)->addHour(14)->addMinute(00)->addSecond(00));
                        $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));
                        });
                })->with("transactionSummaryReceipt.jobOrder.getClient.forCSA", 'transactionSummaryReceipt.getPaymentType', 'transactionSummaryReceipt.getCollect', "transactionSummaryInvoice.jobOrder.getClient.forCSA", 'transactionSummaryInvoice.getPaymentType', 'transactionSummaryInvoice.getCollect', 'transactionSummaryInvoice.getInvoiceType')->get()->groupBy('transactionSummaryInvoice.getInvoiceType.invoice_type');
        }else{

            $job_order = JobOrder::whereIn('payment_status_id', [12, 13])
                ->whereIn('status', [1,2,3,4,9])
                ->when($this->start_date, function($query) {                               
                    $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(1)->addHour(14)->addMinute(00)->addSecond(00));
                    $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));
            })->with("getClient","getCSA", "WorkOrders")->get();

            $transaction_top_part = TransactionSummary::where('transaction_type_id', 2)
            ->where('transaction_status_id', 2)
            ->where('status_id', 13)
            ->whereHas('jobOrder', function ($query) {
                    return $query->where('overall_total', '!=', null);
                })
            ->when($this->start_date, function($query) {  
                $query->where('date', '>=',Carbon::parse($this->start_date)->subDays(1)->addHour(14)->addMinute(00)->addSecond(00));
                $query->where('date', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));                       
            })->with('jobOrder.getClient.forCSA', 'getPaymentType', 'getInvoiceType')->get()->groupBy('getInvoiceType.invoice_type');

            $transaction_particulars = TransactionParticular::whereHas('transactionSummaryReceipt', function ($query) {
                return $query->where('transaction_type_id', ServiceInvoice::RECEIPTS_PAYMENTS)
                    ->where('status_id', 12)
                    ->when($this->start_date, function($query) {                               
                        $query->where('created_at', '>=',Carbon::parse($this->start_date)->subDays(1)->addHour(14)->addMinute(00)->addSecond(00));
                        $query->where('created_at', '<=',Carbon::parse($this->start_date)->addHour(13)->addMinute(59)->addSecond(59));
                        });
                })->with("transactionSummaryReceipt.jobOrder.getClient.forCSA", 'transactionSummaryReceipt.getPaymentType', 'transactionSummaryReceipt.getCollect', "transactionSummaryInvoice.jobOrder.getClient.forCSA", 'transactionSummaryInvoice.getPaymentType', 'transactionSummaryInvoice.getCollect', 'transactionSummaryInvoice.getInvoiceType')->get()->groupBy('transactionSummaryInvoice.getInvoiceType.invoice_type');
        }

        $job_order_pending = JobOrder::with("getClient","getCSA", "WorkOrders", 'getJobOrderTransaction')
            ->whereIn('status', [1,2,3,4])
            ->get();

        // $job_order_pending = JobOrder::where('payment_status_id', 13)
        //     ->whereIn('status', [1,2,3,4])->with("getClient","getCSA", "WorkOrders")->get();

        return view('livewire.report.reconciliation-table',[
            'job_order'           => $job_order,
            'job_order_pending' => $job_order_pending,
            'start_d' => $start,
            'transaction_particulars' => $transaction_particulars,
            'transaction_top_part' => $transaction_top_part,
        ]);
    }
}
