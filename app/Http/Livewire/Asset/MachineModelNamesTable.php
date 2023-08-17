<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineModelName;
use Livewire\Component;
use Livewire\WithPagination;

class MachineModelNamesTable extends Component
{
    use WithPagination;
    public $machineModelName, $machine_model_name;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachineModelName',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachinemodelnamemodal');
    }

    public function edit($machine_model_name){

        $this->emit('machinemodelnameID', $machine_model_name);
        $this->emit('openmachinemodelnamemodal');
    }

    public function delete($machine_model_name){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachineModelName', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machine_model_name
        ]);
    }

    public function deleteMachineModelName($machine_model_name){

        MachineModelName::destroy($machine_model_name);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-model-names-table', [
            'model_names'=>MachineModelName::all(),
        ]);
    }
}
