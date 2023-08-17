<?php

namespace App\Http\Livewire\Billing;

use Livewire\Component;
use App\Models\TransactionTypes;
use Livewire\WithPagination;

class TransactionTypesTable extends Component
{
    use WithPagination;

    public $transactiontypesID ;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteTransactionTypes',
    ];
    
    public function render()
    {
        return view('livewire.billing.transaction-types-table',[
            'transactiontypes' => TransactionTypes::all()
        ]);
    }

    public function createTransactionTypes(){
        $this->emit('resetInputFields');
        $this->emit('openTransactionTypesModal');
    }

    
    public function editTransactionTypes($transactiontypesID){
        $this->transactiontypesID = $transactiontypesID;
        $this->emit('transactiontypesID',$this->transactiontypesID);
        $this->emit('openTransactionTypesModal');
    }

    public function deleteConfirmTransaction($transactiontypesID){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmTransactionTypesDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $transactiontypesID
        ]);
    }

    public function deleteTransactionTypes($transactiontypesID){
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        TransactionTypes::destroy($transactiontypesID);
        $this->resetPage();
    }
}
