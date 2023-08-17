<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachinePurchaseFrom;
use Livewire\Component;

class MachinePurchaseFromForm extends Component
{

    public $machine_purchase_from_name;
    public $machinePurchaseFromID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machinePurchaseFromID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machinePurchaseFromID($machinePurchaseFromID){

        $this->machinePurchaseFromID = $machinePurchaseFromID;
        $purchase_from = MachinePurchaseFrom::find($machinePurchaseFromID);
        $this->machine_purchase_from_name = $purchase_from->machine_purchase_from_name;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_purchase_from_name' => 'required'
        ]);
        
        try{

            if($this->machinePurchaseFromID){

                MachinePurchaseFrom::find($this->machinePurchaseFromID)->update($data);

            }else{

                MachinePurchaseFrom::create($data);

            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machinePurchaseFromID){
            $action = 'edit';
            $message = 'Machine Purchased from Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Machine Purchased from Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachinepurchasefrommodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-purchase-from-form');
    }
}
