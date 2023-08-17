<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineGroup;
use Livewire\Component;

class MachineGroupTable extends Component
{
    public $machineGroupId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
    ];

    public function createMachineGroup()
    {
        $this->emit('resetInputFields');
        $this->emit('openMachineGroupModal');
    }

    public function editMachineGroup($id)
    {
        $this->machineGroupId = $id;
        $this->emit('editMachineGroupId', $this->machineGroupId);
        $this->emit('openMachineGroupModal');
    }

    public function render()
    {
        return view('livewire.asset.machine-group-table',[
            'machine_group' => MachineGroup::with('getMachineGroupIdNumber')->get(),
        ]);
    }

    public function deleteConfirmMachineGroup($id)
    {
        $this->dispatchBrowserEvent('swal:deleteConfirmMachineGroup', [
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
    
        MachineGroup::destroy($id);
        $this->reset();
    }
}
