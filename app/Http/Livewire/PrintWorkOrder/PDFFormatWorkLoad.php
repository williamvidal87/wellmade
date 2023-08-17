<?php

namespace App\Http\Livewire\PrintWorkOrder;

use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;

class PDFFormatWorkLoad extends Component
{
    public function render()
    {
        return view('livewire.print-work-order.p-d-f-format-work-load');
    }
}
