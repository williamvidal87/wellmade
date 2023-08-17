<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineConditionAquired;
use Livewire\Component;
use Livewire\WithPagination;

class MachineConditionAquiredTable extends Component
{
    use WithPagination;
    public $machineconditionacquired, $machine_condition_acquired_name;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachineConditionAcquiredName',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachineconditionnamemodal');
    }

    public function edit($machineConditionAquired){

        $this->emit('machineconditionaquired', $machineConditionAquired);
        $this->emit('openmachineconditionnamemodal');
    }

    public function delete($machineConditionAquired){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachineConditionAquiredName', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machineConditionAquired
        ]);
    }

    public function deleteMachineConditionAcquiredName($machineConditionAquired){

        MachineConditionAquired::destroy($machineConditionAquired);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-condition-aquired-table', [
            'condition_acquired'=>MachineConditionAquired::all(),
        ]);
    }
}
