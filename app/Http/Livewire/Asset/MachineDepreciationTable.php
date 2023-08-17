<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineDepreciation;
use Livewire\Component;
use Livewire\WithPagination;

class MachineDepreciationTable extends Component
{
    use WithPagination;
    public $machinedepreciation;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachineDecpreciation',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachinedepreciationmodal');
    }

    public function edit($machinedepreciationID){

        $this->emit('machinedepreciationID', $machinedepreciationID);
        $this->emit('openmachinedepreciationmodal');
    }

    public function delete($machinedepreciationID){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachineDepreciation', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machinedepreciationID
        ]);
    }

    public function deleteMachineDecpreciation($machinedepreciationID){

        MachineDepreciation::destroy($machinedepreciationID);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-depreciation-table', [
            'machine_dep'=>MachineDepreciation::all(),
        ]);
    }
}
