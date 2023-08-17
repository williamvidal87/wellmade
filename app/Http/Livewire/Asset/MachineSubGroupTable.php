<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineSubGroupName;
use Livewire\Component;

class MachineSubGroupTable extends Component
{
   
    public $machineSubGroupId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
    ];

    public function createMachineSubGroup()
    {
        $this->emit('openMachineSubGroupModal');
    }

    public function editMachineSubGroup($id)
    {
        $this->machineSubGroupId = $id;   
        // dd($this->machineSubGroupId);
        $this->emit('editMachineSubGroupId', $this->machineSubGroupId);
        $this->emit('openMachineSubGroupModal');
    }

    public function render()
    {
        return view('livewire.asset.machine-sub-group-table', [
            'machine_sub_group' => MachineSubGroupName::all()
        ]);
    }
   

    public function deleteConfirmMachineSubGroup($id)
    {
        $this->dispatchBrowserEvent('swal:deleteConfirmMachineSubGroup', [
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
    
        MachineSubGroupName::destroy($id);
        $this->reset();
    }
}
