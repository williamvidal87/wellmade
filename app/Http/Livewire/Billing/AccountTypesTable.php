<?php

namespace App\Http\Livewire\Billing;

use App\Models\AccountTypes;
use Livewire\Component;
use Livewire\WithPagination;

class AccountTypesTable extends Component
{
    use WithPagination;

    public $accounttypesID ;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteAccountTypes',
    ];
    
    public function render()
    {
        return view('livewire.billing.account-types-table',[
            'accounttypes' => AccountTypes::all()
        ]);
    }

    public function createAccountTypes(){
        $this->emit('resetInputFields');
        $this->emit('openAccountTypesModal');
    }

    
    public function editAccountTypes($accounttypesID){
        $this->accounttypesID = $accounttypesID;
        $this->emit('accounttypesID',$this->accounttypesID);
        $this->emit('openAccountTypesModal');
    }

    public function deleteConfirmAccountTypes($accounttypesID){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmAccountTypesDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $accounttypesID
        ]);
    }

    public function deleteAccountTypes($accounttypesID){
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        AccountTypes::destroy($accounttypesID);
        $this->resetPage();
    }
}
