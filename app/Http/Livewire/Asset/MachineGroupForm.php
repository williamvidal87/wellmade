<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineCategory;
use App\Models\MachineGroup;
use App\Models\MachineIdNumber;
use Livewire\Component;

class MachineGroupForm extends Component
{
    public $machine_group_category_id, $machine_group_number_id, $machine_group_name;
    public $machineGroupId;

    protected $listeners = [
        'editMachineGroupId',
        'resetInputFields'
    ];
    
    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function editMachineGroupId($id)
    {
        $this->machineGroupId = $id;

        $machineGroup = MachineGroup::find($id);
        $this->machine_group_category_id = $machineGroup->machine_group_category_id;
        $this->machine_group_number_id   = $machineGroup->machine_group_number_id;
        $this->machine_group_name        = $machineGroup->machine_group_name;
    }

    public function store()
    {
        $data = $this->validate([
            'machine_group_category_id' => 'required',
            'machine_group_number_id'  => '',
            'machine_group_name'  => 'required'
        ]);

        try {

            if($this->machineGroupId) {
                               
               MachineGroup::find($this->machineGroupId)->update($data);

            }else{
                // dd($data);
                MachineGroup::create($data);
            }

        }catch(\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }
        if($this->machineGroupId){
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
        $this->emit('closeMachineGroupModal');       
    }

    public function render()
    {
        return view('livewire.asset.machine-group-form',[
            'machine_category' => MachineCategory::all(),
            'machine_number' => MachineIdNumber::all()
        ]);
    }
}
