<?php

namespace App\Http\Livewire\Asset;

use App\Models\AssignMachineSubgroup;
use App\Models\MachineGroup;
use App\Models\MachineIdNumber;
use App\Models\MachineSubGroupName;
use Livewire\Component;

class AssignMachineSubGroupForm extends Component
{
   
    public $machine_sub_group_number_id, $machine_group_id, $machine_sub_group_id;
    public $assignMachineSubGroupId;
    
    protected $listeners = [
        'editAssignMachineSubGroupId',
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
        return view('livewire.asset.assign-machine-sub-group-form', [
            'machine_number' => MachineIdNumber::all(),
            'machine_group'  => MachineGroup::all(),
            'machine_sub_group' => MachineSubGroupName::all(),
            'check_machine_number_exist' => AssignMachineSubgroup::select('machine_sub_group_number_id')->get()
        ]);
    }


    public function editAssignMachineSubGroupId($id)
    {      
        $this->assignMachineSubGroupId = $id;     

        $assignMachineSubGroup = AssignMachineSubgroup::find($id);
        $this->machine_sub_group_number_id = $assignMachineSubGroup->machine_sub_group_number_id;
        $this->machine_group_id = $assignMachineSubGroup->machine_group_id;
        $this->machine_sub_group_id =$assignMachineSubGroup->machine_sub_group_id;

    }

    public function store()
    {
        $data = $this->validate([
            'machine_sub_group_number_id' => 'required',
            'machine_group_id' => 'required',
            'machine_sub_group_id' => 'required'
        ]);
        
        $check_assign_number2=AssignMachineSubgroup::Where('machine_sub_group_number_id',$this->machine_sub_group_number_id)->get()->first();
        if($check_assign_number2!=null){
            request()->validate([
                'machine_sub_group_number_id' => 'required',
            ],
            [
                'machine_sub_group_number_id.required' => 'This id number is already exist',
            ]);
        }

        try {
            if($this->assignMachineSubGroupId) {
                AssignMachineSubgroup::find($this->assignMachineSubGroupId)->update($data);
            }else{
                AssignMachineSubgroup::create($data);
            }
           
        }catch(\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }
        if($this->assignMachineSubGroupId){
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
        $this->emit('closeAssignMachineSubGroupModal');       

    }   
}
