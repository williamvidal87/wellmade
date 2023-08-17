<?php

namespace App\Http\Livewire\CRM;

use Livewire\Component;

class ContactLogForm extends Component
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
        $this->emit('closeContactLogModal');
    }

    public function render()
    {
        return view('livewire.c-r-m.contact-log-form');
    }
}
