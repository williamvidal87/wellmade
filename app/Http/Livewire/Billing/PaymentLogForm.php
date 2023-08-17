<?php

namespace App\Http\Livewire\Billing;

use App\Models\ActivityLogTable;
use App\Models\ActivityLogType;
use Carbon\Carbon;
use Livewire\Component;

class PaymentLogForm extends Component
{

    public $start_date, $end_date;

    protected $listeners = [
        'filter',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function filter()
    {
        $this->emit('filter_date', $this->start_date, $this->end_date);
        $this->emit('closePaymentLogModal');
    }

    public function render()
    {
        return view('livewire.billing.payment-log-form');
    }
}
