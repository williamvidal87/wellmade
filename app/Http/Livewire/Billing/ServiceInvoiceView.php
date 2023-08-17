<?php

namespace App\Http\Livewire\Billing;

use App\Enums\TransactionStatus;
use App\Models\TransactionData;
use App\Models\TransactionSummary;
use Livewire\Component;
use PDF;

class ServiceInvoiceView extends Component
{

    public $date, /*$receipt_no,*/ $receipt_for, $for, $jo_no, $customer_name, $sb_date, $serviceInvoiceId, $accnt_no, $account_title, $debits, $credits, $all_total_debits, $all_total_credits;
    public $listItems = [];
    public $oldItems = [];
    public $action = '';
    public $message = '';
    public $receipt_no = '';
    public $transaction_status;

    protected $listeners = [
        'refreshParentServiceInvoiceView' => '$refresh',
        'serviceInvoiceId',
    ];

    public function printReports($id)
    {
        $report_data = TransactionSummary::where('id', $id)->with('receiptType', 'jobOrder.clientProfile', 'receiptFor', 'fors', 'bankType')->get();
        $items = TransactionData::where('transaction_summary_id', $id)->with('chartOfAccounts')->get();
        $pdf  = PDF::loadView('livewire.transaction-print.transaction', ['report_data' => $report_data, 'items' => $items])->output();
        return response()->streamDownload(
            fn () => print($pdf),
            "service-invoice.pdf"
        );
    }

    //edit
    public function serviceInvoiceId($serviceInvoiceId)
    {
        $this->serviceInvoiceId = $serviceInvoiceId;

        $serviceInvoice = TransactionSummary::find($serviceInvoiceId);

        $this->transaction_status = $serviceInvoice->transaction_status_id;
    }

    public function transactionConfirmServiceInvoice($serviceInvoiceId, $data)
    {
        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmServiceInvoiceTransaction', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, accept it!',
            'id' => $serviceInvoiceId,
            'data' => $data
        ]);
    }

    public function deleteServiceInvoice($serviceInvoiceId, $data)
    {
        if($data == "posted"){
            TransactionSummary::where('id',$serviceInvoiceId)->update([
                'transaction_status_id' => TransactionStatus::POSTED,
            ]);
        }elseif($data == "reversed"){
            TransactionSummary::where('id',$serviceInvoiceId)->update([
                'transaction_status_id' => TransactionStatus::REVERSED,
            ]);
        }

        $this->resetPage();
        // $this->emit('refreshParent');
    }

    public function render()
    {
        $report_data = TransactionSummary::with('jobOrder.clientProfile', 'receiptFor', 'fors')->where('id', $this->serviceInvoiceId)->get();  
        $items = TransactionData::with('chartOfAccounts')->where('transaction_summary_id', $this->serviceInvoiceId)->get();
        return view('livewire.billing.service-invoice-view', [
            'report_data' => $report_data,
            'items' => $items,
        ]);
    }
}
