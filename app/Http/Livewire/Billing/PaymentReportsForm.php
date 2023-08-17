<?php

namespace App\Http\Livewire\Billing;

use App\Models\InvoiceTypes;
use Livewire\Component;

class PaymentReportsForm extends Component
{

    public $month, $invoice_type;

    public function filter()
    {
        $this->emit('filter_date', $this->month, $this->invoice_type);
        $this->emit('closePaymentReportModal');
    }

    public function render()
    {
        return view('livewire.billing.payment-reports-form', [
            'inv_types' => InvoiceTypes::all(),
        ]);
    }
}
