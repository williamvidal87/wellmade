<?php

namespace App\Http\Livewire\CRM;

use Livewire\Component;
use App\Models\ClientType;
use App\Models\CsaType;
use App\Models\ClientProfile;

class ClientReportListingForm extends Component
{
    public $client_type, $start_date, $end_date;

    public function generated()
    {
        // dd($this->client_type);   
        $this->emit('closeModal');   

    }

    public function render()
    {
        return view('livewire.c-r-m.client-report-listing-table');
    }
}
