<?php

namespace App\Http\Livewire\Machine;

use Livewire\Component;
use App\Models\Machining_Fabrication;
use Livewire\WithPagination;

class MachineandFabricationList extends Component
{
    use WithPagination;
    public $machineANDfabricationLISTId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachineandFabricationList'
    ];

    public function editMachineandFabricationList($machineANDfabricationListID)
    {

        $this->machineANDfabricationLISTId = $machineANDfabricationListID;
        $this->emit('machineANDfabricationlistID', $this->machineANDfabricationLISTId);
        $this->emit('openMachineandFabricationListModal');
    }

    public function deleteConfirmMachineandFabricationList($machineANDfabricationlistID)
    {
        $this->dispatchBrowserEvent('swal:confirmMachineandFabricationListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machineANDfabricationlistID
        ]);
    }

    public function render()
    {
        return view('livewire.machine.machineand-fabrication-list', [
            'machineandFabricationList' => Machining_Fabrication::all()->sortBy('id')
        ]);
    }
    public function createMachineandFabricationList()
    {
        $this->emit('resetInputFields');
        $this->emit('openMachineandFabricationListModal');
    }

    public function deleteMachineandFabricationList($machineANDfabricationListId)
    {
        Machining_Fabrication::destroy($machineANDfabricationListId);
        $this->reset();
    }
}