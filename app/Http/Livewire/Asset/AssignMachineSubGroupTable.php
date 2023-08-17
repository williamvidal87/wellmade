<?php

namespace App\Http\Livewire\Asset;

use App\Models\AssignMachineSubgroup;
use App\Models\MachineGroup;
use App\Models\MachineIdNumber;
use App\Models\MachineSubGroupName;
use Livewire\Component;

class AssignMachineSubGroupTable extends Component
{
   
   
    public $assignMachineSubGroupId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
    ];

    public function createAssignMachineSubGroup()
    {
        $this->emit('reserInputFields');
        $this->emit('openAssignMachineSubGroupModal');
    }

    public function editAssignMachineSubGroup($id)
    {
        $this->assignMachineSubGroupId = $id;   
        // dd($this->assignMachineSubGroupId);
        $this->emit('editAssignMachineSubGroupId', $this->assignMachineSubGroupId);
        $this->emit('openAssignMachineSubGroupModal');
    }

    public function render()
    {
        $assignmachinesubgroup = AssignMachineSubgroup::select('id','machine_sub_group_number_id','machine_group_id','machine_sub_group_id')->with('getMachineNumber','getMachineGroup','getMachineSubGroup')->get();
        return view('livewire.asset.assign-machine-sub-group-table')
        ->with('assignmachinesubgroup',$assignmachinesubgroup);
    }
   

    public function deleteConfirmAssignMachineSubGroup($id)
    {
        $this->dispatchBrowserEvent('swal:deleteConfirmAssignMachineSubGroup', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $id
        ]);
    }
    public function delete($id){
        $action = 'delete';
        $message = ' ';
        // dd($action);
        $this->emit('flashAction',$action,$message);
    
        AssignMachineSubgroup::destroy($id);
        $this->reset();
    }
}
