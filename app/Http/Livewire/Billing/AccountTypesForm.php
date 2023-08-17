<?php

namespace App\Http\Livewire\Billing;

use App\Models\AccountTypes;
use Livewire\Component;

class AccountTypesForm extends Component
{
    public $slug, $accounttypesID, $account_code, $account_type;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'accounttypesID',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function accounttypesID($accounttypesID){
        $this->accounttypesID = $accounttypesID;
        $accounttypes = AccountTypes::find($accounttypesID);
        $this->account_code = $accounttypes->account_code;
        $this->account_type = $accounttypes->account_type;
    }

    public function render()
    {
        return view('livewire.billing.account-types-form');
    }

    
    public function store(){

        $data = $this->validate([
            'account_code' => 'required',
            'account_type' => 'required',
        ]);

        try
		{
            if($this->accounttypesID){
                AccountTypes::find($this->accounttypesID)->update($data); 
            }else{
                AccountTypes::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->accounttypesID){
            $action = 'edit';
            $message = 'AccountTypes Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'AccountTypes Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeAccountTypesModal');
    }
}
