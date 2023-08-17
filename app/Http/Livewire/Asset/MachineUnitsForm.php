<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineUnit;
use Livewire\Component;

class MachineUnitsForm extends Component
{
    public $machine_unit_name;
    public $machineUnitsID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machineUnitsID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machineUnitsID($machineUnitsID){

        $this->machineUnitsID = $machineUnitsID;
        $machine_units = MachineUnit::find($machineUnitsID);
        $this->machine_unit_name = $machine_units->machine_unit_name;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_unit_name' => 'required'
        ]);
        
        try{

            if($this->machineUnitsID){

                MachineUnit::find($this->machineUnitsID)->update($data);

            }else{

                MachineUnit::create($data);

            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machineUnitsID){
            $action = 'edit';
            $message = 'Machine Unit Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Machine Unit Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachineunitsmodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-units-form');
    }
}
