<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachinePlantAssigned;
use Livewire\Component;
use Livewire\WithPagination;

class MachinePlantAssignedTable extends Component
{
    use WithPagination;
    public $machinePlantAssigned, $machine_plant_assigned_name;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachinePlantAssigned',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachineplantassignedmodal');
    }

    public function edit($machineplantassignedID){

        $this->emit('machineplantassignedID', $machineplantassignedID);
        $this->emit('openmachineplantassignedmodal');
    }

    public function delete($machineplantassignedID){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachinePlantAssigned', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machineplantassignedID
        ]);
    }

    public function MachinePlantAssigned($machineplantassignedID){

        MachinePlantAssigned::destroy($machineplantassignedID);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-plant-assigned-table', [
            'plant_assigned'=>MachinePlantAssigned::all(),
        ]);
    }
}
