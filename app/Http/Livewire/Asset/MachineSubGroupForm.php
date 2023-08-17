<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineSubGroupName;
use Livewire\Component;

class MachineSubGroupForm extends Component
{
   
    public $machine_sub_group_name;
    public $machineSubGroupId;
    
    protected $listeners = [
        'editMachineSubGroupId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.asset.machine-sub-group-form');
    }


    public function editMachineSubGroupId($id)
    {      
        $this->machineSubGroupId = $id;     

        $machineSubGroup = MachineSubGroupName::find($id);
        $this->machine_sub_group_name = $machineSubGroup->machine_sub_group_name;
    }

    public function store()
    {
        $data = $this->validate([
            'machine_sub_group_name' => 'required'
        ]);

        try {
            if($this->machineSubGroupId) {
                MachineSubGroupName::find($this->machineSubGroupId)->update($data);
            }else{
                MachineSubGroupName::create($data);
            }
           
        }catch(\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }
        if($this->machineSubGroupId){
            $action = 'edit';
            $message = 'Record Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Record Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }    
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeMachineSubGroupModal');       

    }   
}
