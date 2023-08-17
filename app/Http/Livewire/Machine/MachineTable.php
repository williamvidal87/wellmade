<?php

namespace App\Http\Livewire\Machine;

use Livewire\Component;
use App\Models\Machines;
use Livewire\WithPagination;

class MachineTable extends Component
{
    public $machineListID;
    use WithPagination;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachineList',
    ];

    public function createMachineList()
    {
        $this->emit('resetInputFields');
        $this->emit('openMachineListModal');
    }
    public function editMachineList($machineListID)
    {

        $this->machineListID = $machineListID;
        $this->emit('machinelistID', $this->machineListID);
        $this->emit('openMachineListModal');
    }

    public function deleteConfirmMachineList($machinelistID)
    {
        $this->dispatchBrowserEvent('swal:confirmMachineListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machinelistID
        ]);
    }
    public function render()
    {
        $machineList = Machines::with('getJobTypes')->get();
        return view('livewire.machine.machine-table')->with('machineList',$machineList);
    }

    public function deleteMachineList($machineListId)
    {
        // dd($clientTypeId);
        Machines::destroy($machineListId);
        $this->reset();
    }
}