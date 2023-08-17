<?php

namespace App\Http\Livewire\Billing;

use App\Models\ReceiptFor;
use Livewire\Component;
use Livewire\WithPagination;

class ReceiptForTable extends Component
{

    use WithPagination;

    public $receiptForId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteReceiptFor',
    ];

    public function createReceiptFor()
    {
        $this->emit('resetInputFields');
        $this->emit('openReceiptForModal');
    }


    public function editReceiptFor($receiptForId)
    {
        $this->receiptForId = $receiptForId;
        $this->emit('receiptForId', $this->receiptForId);
        $this->emit('openReceiptForModal');
    }

    public function deleteConfirmReceiptFor($receiptForId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmReceiptForDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $receiptForId
        ]);
    }

    public function deleteReceiptFor($receiptForId)
    {

        ReceiptFor::destroy($receiptForId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.billing.receipt-for-table', [
            'receiptFor' => ReceiptFor::all(),
        ]);
    }
}
