<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineConditionAquired;
use Livewire\Component;

class MachineConditionAcquiredForm extends Component
{
    public $machine_condition_acquired_name;
    public $machineconditionaquired;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machineconditionaquired',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machineconditionaquired($machineconditionaquired){

        $this->machineconditionaquired = $machineconditionaquired;
        $brand_names = MachineConditionAquired::find($machineconditionaquired);
        $this->machine_condition_acquired_name = $brand_names->machine_condition_acquired_name;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_condition_acquired_name' => 'required'
        ]);
        
        try{

            if($this->machineconditionaquired){

                MachineConditionAquired::find($this->machineconditionaquired)->update($data);

            }else{

                MachineConditionAquired::create($data);

            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machineconditionaquired){
            $action = 'edit';
            $message = 'Machine Condition Name Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Machine Condition Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachineconditionnamemodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-condition-acquired-form');
    }
}