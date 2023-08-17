<?php

namespace App\Http\Livewire\Billing;

use App\Models\Bank;
use Livewire\Component;
use Livewire\WithPagination;

class BankTable extends Component
{

    use WithPagination;

    public $bankId;

    protected $listeners = [
        // 'refreshParent' => '$refresh',
        'refreshParentBank' => '$refresh',
        'deleteBank',
    ];

    public function createBank()
    {
        $this->emit('resetInputFields');
        $this->emit('openBankModal');
    }


    public function editBank($bankId)
    {
        $this->bankId = $bankId;
        $this->emit('bankId', $this->bankId);
        $this->emit('openBankModal');
    }

    public function deleteConfirmBank($bankId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmBankDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $bankId
        ]);
    }

    public function deleteBank($bankId)
    {

        Bank::destroy($bankId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.billing.bank-table', [
            'bank' => Bank::all(),
        ]);
    }
}
