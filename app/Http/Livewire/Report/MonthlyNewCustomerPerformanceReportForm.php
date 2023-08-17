<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;

class MonthlyNewCustomerPerformanceReportForm extends Component
{
    public $option_one, $option_two;

    public function filter()
    {
        $this->emit('filter_date', $this->option_one, $this->option_two);
        $this->emit('closeMonthlyNewCustomerModal');
    }

    public function render()
    {
        return view('livewire.report.monthly-new-customer-performance-report-form');
    }
}
