<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;

class WeeklyRevenueCsaForm extends Component
{

    public $start_date, $end_date;

    public function filter()
    {
        $this->emit('filter_date', $this->start_date, $this->end_date);
        $this->emit('closeWeeklyRevenueCsaModal');
    }

    public function render()
    {
        return view('livewire.report.weekly-revenue-csa-form');
    }
}
