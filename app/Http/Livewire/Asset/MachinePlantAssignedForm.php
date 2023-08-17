<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachinePlantAssigned;
use Livewire\Component;

class MachinePlantAssignedForm extends Component
{
    public $machine_plant_assigned_name;
    public $machineplantassignedID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machineplantassignedID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machineplantassignedID($machineplantassignedID){

        $this->machineplantassignedID = $machineplantassignedID;
        $plant_assigned = MachinePlantAssigned::find($machineplantassignedID);
        $this->machine_plant_assigned_name = $plant_assigned->machine_plant_assigned_name;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_plant_assigned_name' => 'required'
        ]);
        
        try{

            if($this->machineplantassignedID){

                MachinePlantAssigned::find($this->machineplantassignedID)->update($data);

            }else{

                MachinePlantAssigned::create($data);

            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machineplantassignedID){
            $action = 'edit';
            $message = 'Machine Plant Assigned Name Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Machine Plant Assigned Name Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachineplantassignedmodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-plant-assigned-form');
    }
}
