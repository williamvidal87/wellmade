<?php

namespace App\Http\Livewire\Billing;

use Livewire\Component;
use App\Models\TransactionTypes;

class TransactionTypesForm extends Component
{
    public $slug, $transactiontypesID, $transaction_type;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'transactiontypesID',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function transactiontypesID($transactiontypesID){
        $this->transactiontypesID = $transactiontypesID;
        $transactiontypes = TransactionTypes::find($transactiontypesID);
        $this->transaction_type = $transactiontypes->transaction_type;
    }

    public function render()
    {
        return view('livewire.billing.transaction-types-form');
    }

    
    public function store(){

        $data = $this->validate([
            'transaction_type' => 'required',
        ]);

        try
		{
            if($this->transactiontypesID){
                TransactionTypes::find($this->transactiontypesID)->update($data);
            }else{
                TransactionTypes::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->transactiontypesID){
            $action = 'edit';
            $message = 'Transaction Type Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Transaction Type Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeTransactionTypesModal');
    }
}
