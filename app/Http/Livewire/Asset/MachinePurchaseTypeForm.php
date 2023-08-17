<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachinePurchaseType;
use Livewire\Component;

class MachinePurchaseTypeForm extends Component
{
    
    public $machine_purchase_type_name;
    public $machinePurchaseTypeID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machinePurchaseTypeID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machinePurchaseTypeID($machinePurchaseTypeID){

        $this->machinePurchaseTypeID = $machinePurchaseTypeID;
        $purchase_type = MachinePurchaseType::find($machinePurchaseTypeID);
        $this->machine_purchase_type_name = $purchase_type->machine_purchase_type_name;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_purchase_type_name' => 'required'
        ]);
        
        try{

            if($this->machinePurchaseTypeID){

                MachinePurchaseType::find($this->machinePurchaseTypeID)->update($data);

            }else{

                MachinePurchaseType::create($data);

            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machinePurchaseTypeID){
            $action = 'edit';
            $message = 'Machine Purchased type Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Machine Purchased type Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachinepurchasetypemodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-purchase-type-form');
    }
}
