<?php

namespace App\Http\Livewire\Billing;

use App\Models\JoAcknowledgementReceipt;
use App\Models\JobOrder;
use App\Models\TransactionSummary;
use Livewire\Component;

class JoAcknowledgementReceiptInvoicesTable extends Component
{
    public $joAcknowledgementReceiptInvoicesId;
    public $joInvoices = [];
    public $dicount;
    protected $listeners = [
        'joAcknowledgementReceiptInvoicesId',
    ];

    public function joAcknowledgementReceiptInvoicesId($id)
    {
        // Get the JO
        $this->joInvoices = TransactionSummary::with('jobOrder', 'getInvoiceType')
        ->where('jo_no', $id)
        ->where('transaction_type_id', 2)
        ->where('transaction_status_id', 2)
        ->where('status_id', 12)
        ->get();
        
    }

    public function render()
    {
        return view('livewire.billing.jo-acknowledgement-receipt-invoices-table', [
            'jo_acknowledgement_receipt_invoices' => $this->joInvoices,
        ]);
    }
}
