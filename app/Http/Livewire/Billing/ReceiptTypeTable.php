<?php

namespace App\Http\Livewire\Billing;

use App\Models\ReceiptTypes;
use Livewire\Component;
use Livewire\WithPagination;

class ReceiptTypeTable extends Component
{

    use WithPagination;

    public $receiptTypeId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteReceiptType',
    ];

    public function createReceiptType()
    {
        $this->emit('resetInputFields');
        $this->emit('openReceiptTypeModal');
    }


    public function editReceiptType($receiptTypeId)
    {
        $this->receiptTypeId = $receiptTypeId;
        $this->emit('receiptTypeId', $this->receiptTypeId);
        $this->emit('openReceiptTypeModal');
    }

    public function deleteConfirmReceiptType($receiptTypeId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmReceiptTypeDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $receiptTypeId
        ]);
    }

    public function deleteReceiptType($receiptTypeId)
    {

        ReceiptTypes::destroy($receiptTypeId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.billing.receipt-type-table', [
            'receiptType' => ReceiptTypes::all(),
        ]);
    }
}
