<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineDepreciation;
use Livewire\Component;

class MachineDepreciationForm extends Component
{
    public $machine_depreciation_number;
    public $machinedepreciationID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machinedepreciationID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machinedepreciationID($machinedepreciationID){

        $this->machinedepreciationID = $machinedepreciationID;
        $country_made = MachineDepreciation::find($machinedepreciationID);
        $this->machine_depreciation_number = $country_made->machine_depreciation_number;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_depreciation_number' => 'required'
        ]);
        
        try{

            if($this->machinedepreciationID){

                MachineDepreciation::find($this->machinedepreciationID)->update($data);

            }else{

                MachineDepreciation::create($data);

            }
        } catch (\Exception $e){
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machinedepreciationID){
            $action = 'edit';
            $message = 'Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachinedepreciationmodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-depreciation-form');
    }
}
