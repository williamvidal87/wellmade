<?php

namespace App\Http\Livewire\Billing;

use App\Models\CounterReceipt;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class CounterReceiptTable extends Component
{
    use WithPagination;

    public $counterReceiptId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteCounterReceipt',
    ];

    public function createCounterReceipt()
    {
        $this->emit('resetInputFields');
        $this->emit('openCounterReceiptModal');
        $this->emit('select2');
        $this->emit('counterReceiptDate', Carbon::today());
    }

    public function payCounterReceipt($counterReceiptId)
    {
        $this->counterReceiptId = $counterReceiptId;
        $this->emit('payCounterReceiptId', $this->counterReceiptId);
        $this->emit('openCounterReceiptModal');
    }

    public function viewCounterReceipt($counterReceiptId)
    {
        $this->counterReceiptId = $counterReceiptId;
        $this->emit('viewCounterReceiptId', $this->counterReceiptId);
        $this->emit('openCounterReceiptModal');
    }

    public function editCounterReceipt($counterReceiptId)
    {
        $this->counterReceiptId = $counterReceiptId;
        $this->emit('counterReceiptId',$this->counterReceiptId);
        $this->emit('openCounterReceiptModal');
    }

    public function deleteConfirmCounterReceipt($counterReceiptId)
    {
        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmCounterReceiptDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $counterReceiptId
        ]);
    }
    
    public function deleteCounterReceipt($counterReceiptId)
    {
        CounterReceipt::destroy($counterReceiptId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.billing.counter-receipt-table', [
            'counter_receipts' => CounterReceipt::with('getClient', 'getTransactionStatus', 'getCounterReceiptData.getTransactionSummary')->get(),
        ]);
    }
}
