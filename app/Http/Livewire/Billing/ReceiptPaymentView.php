<?php

namespace App\Http\Livewire\Billing;

use App\Models\TransactionData;
use App\Models\TransactionSummary;
use Livewire\Component;
use PDF;

class ReceiptPaymentView extends Component
{

    public $date, /*$receipt_no,*/ $receipt_for, $for, $jo_no, $customer_name, $sb_date, $serviceInvoiceId, $accnt_no, $account_title, $debits, $credits, $all_total_debits, $all_total_credits;
    public $listItems = [];
    public $oldItems = [];
    public $action = '';
    public $message = '';
    public $receipt_no = '';
    private $transactionService;

    protected $listeners = [
        'serviceInvoiceId',
    ];

    public function printReports($id)
    {        
        $report_data = TransactionSummary::where('id', $id)->with('receiptType', 'jobOrder', 'receiptFor', 'fors', 'bankType')->get();
        $items = TransactionData::where('transaction_summary_id', $id)->with('chartOfAccounts')->get();
        $pdf  = PDF::loadView('livewire.transaction-print.receipt-payment', ['report_data' => $report_data, 'items' => $items])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"receipt-payment.pdf"
        );    
    }

    //edit
    public function serviceInvoiceId($serviceInvoiceId)
    {
        $this->serviceInvoiceId = $serviceInvoiceId;
    }

    public function render()
    {
        $report_data = TransactionSummary::with('receiptType', 'jobOrder.clientProfile', 'receiptFor', 'fors', 'bankType')->where('id', $this->serviceInvoiceId)->get();  
        $items = TransactionData::with('chartOfAccounts')->where('transaction_summary_id', $this->serviceInvoiceId)->get();
        return view('livewire.billing.receipt-payment-view', [
            'report_data' => $report_data,
            'items' => $items,
        ]);
    }
}
