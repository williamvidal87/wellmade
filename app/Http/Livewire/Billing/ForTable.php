<?php

namespace App\Http\Livewire\Billing;

use App\Models\TransactionFor;
use Livewire\Component;
use Livewire\WithPagination;

class ForTable extends Component
{

    use WithPagination;

    public $forId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteFor',
    ];

    public function createFor()
    {
        $this->emit('resetInputFields');
        $this->emit('openForModal');
    }


    public function editFor($forId)
    {
        $this->forId = $forId;
        $this->emit('forId', $this->forId);
        $this->emit('openForModal');
    }

    public function deleteConfirmFor($forId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmForDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $forId
        ]);
    }

    public function deleteFor($forId)
    {

        TransactionFor::destroy($forId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.billing.for-table', [
            'for' => TransactionFor::all(),
        ]);
    }
}
