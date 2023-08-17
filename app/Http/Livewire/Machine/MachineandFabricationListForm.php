<?php

namespace App\Http\Livewire\Machine;

use Livewire\Component;
use App\Models\Machining_Fabrication;

class MachineandFabricationListForm extends Component
{
    public $machineANDfabricationListID, $mf_name, $message, $action;

    protected $listeners = [
        'machineANDfabricationlistID',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machineANDfabricationlistID($machineANDfabricationListID)
    {
        $this->machineANDfabricationListID = $machineANDfabricationListID;
        $machine_fabrication_List = Machining_Fabrication::find($machineANDfabricationListID);
        $this->mf_name = $machine_fabrication_List->mf_name;
    }
    public function render()
    {
        return view('livewire.machine.machineand-fabrication-list-form');
    }

    public function tablemodal()
    {
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeMachineandFabricationListModal');
    }

    public function store()
    {
        $data = $this->validate([
            'mf_name' => 'required',
        ]);

        try {
            if ($this->machineANDfabricationListID) {
                Machining_Fabrication::find($this->machineANDfabricationListID)->update($data);
            } else {
                Machining_Fabrication::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->machineANDfabricationListID) {
            $action = 'edit';
            $message = 'Machine and Fabrication Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Machine and Fabrication Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeMachineandFabricationListModal');
    }
}