<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineUnit;
use Livewire\Component;
use Livewire\WithPagination;

class MachineUnitsTable extends Component
{
    use WithPagination;
    public $machineStatuses, $machine_unit_name;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteUnits',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachineunitsmodal');
    }

    public function edit($machineUnitID){

        $this->emit('machineUnitsID', $machineUnitID);
        $this->emit('openmachineunitsmodal');
    }

    public function delete($machineunitsID){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachineUnits', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machineunitsID
        ]);
    }

    public function deleteUnits($machineunitsID){

        MachineUnit::destroy($machineunitsID);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-units-table', [
            'units' => MachineUnit::all(),
        ]);
    }
}
