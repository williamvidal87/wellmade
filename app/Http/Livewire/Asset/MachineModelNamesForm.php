<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineModelName;
use Livewire\Component;

class MachineModelNamesForm extends Component
{
    public $machine_model_name;
    public $machinemodelnameID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machinemodelnameID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machinemodelnameID($machinemodelnameID){

        $this->machinemodelnameID = $machinemodelnameID;
        $brand_names = MachineModelName::find($machinemodelnameID);
        $this->machine_model_name = $brand_names->machine_model_name;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_model_name' => 'required'
        ]);
        
        try{

            if($this->machinemodelnameID){

                MachineModelName::find($this->machinemodelnameID)->update($data);

            }else{

                MachineModelName::create($data);

            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machinemodelnameID){
            $action = 'edit';
            $message = 'Model Name Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Model Name Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachinemodelnamemodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-model-names-form');
    }
}
