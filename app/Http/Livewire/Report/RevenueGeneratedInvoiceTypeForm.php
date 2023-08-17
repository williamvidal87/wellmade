<?php

namespace App\Http\Livewire\Report;

use App\Models\InvoiceTypes;
use Livewire\Component;

class RevenueGeneratedInvoiceTypeForm extends Component
{

    public $start_date, $end_date, $invoice_type;

    public function filter()
    {
        $this->emit('filter_date', $this->start_date, $this->end_date, $this->invoice_type);
        $this->emit('closeRevenueGeneratedInvoiceTypeModal');
    }

    public function render()
    {
        return view('livewire.report.revenue-generated-invoice-type-form', [
            'inv_types' => InvoiceTypes::all(),
        ]);
    }
}
