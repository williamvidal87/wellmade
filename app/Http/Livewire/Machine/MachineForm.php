<?php

namespace App\Http\Livewire\Machine;

use App\Models\JobTypes;
use Livewire\Component;
use App\Models\Machines;

class MachineForm extends Component
{
    public $machineListID,$job_type_id, $machine_name, $action, $message;

    protected $listeners = [
        'machinelistID',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machinelistID($machineListID)
    {

        $this->machineListID = $machineListID;
        $machineList = Machines::find($machineListID);
        $this->job_type_id = $machineList->job_type_id;
        $this->machine_name = $machineList->machine_name;
    }

    public function render()
    {
        return view('livewire.machine.machine-form',[
            'jobtypes' =>   JobTypes::all()
        ]);
    }

    public function tablemodal()
    {
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeMachineListModal');
    }

    public function store()
    {
        $data = $this->validate([
            'job_type_id' => 'required',
            'machine_name' => 'required',
        ]);

        try {
            if ($this->machineListID) {
                Machines::find($this->machineListID)->update($data);
            } else {
                Machines::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->machineListID) {
            $action = 'edit';
            $message = 'Machine Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Machine Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeMachineListModal');
    }
}