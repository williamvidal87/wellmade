<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineStatus;
use Livewire\Component;
use Livewire\WithPagination;

class MachineStatusesTable extends Component
{
    use WithPagination;
    public $machineStatuses, $machine_unit_name;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachineStatuses',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachinestatusesmodal');
    }

    public function edit($machineStatusesID){

        $this->emit('machineStatusesID', $machineStatusesID);
        $this->emit('openmachinestatusesmodal');
    }

    public function delete($machinestatusesID){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachineStatuses', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machinestatusesID
        ]);
    }

    public function deleteMachineStatuses($machinestatusesID){

        MachineStatus::destroy($machinestatusesID);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-statuses-table', [
            'statuses' => MachineStatus::all(),
        ]);
    }
}
