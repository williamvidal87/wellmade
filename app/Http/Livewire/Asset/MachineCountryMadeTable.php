<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineCountryMade;
use Livewire\Component;
use Livewire\WithPagination;

class MachineCountryMadeTable extends Component
{
    use WithPagination;
    public $openmachinecountrymade;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachineCountryMade',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachinecountrymademodal');
    }

    public function edit($machinecountrymadeID){

        $this->emit('machinecountrymadeID', $machinecountrymadeID);
        $this->emit('openmachinecountrymademodal');
    }

    public function delete($machinecountrymadeID){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachineCountryMade', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machinecountrymadeID
        ]);
    }

    public function deleteMachineCountryMade($machinecountrymadeID){

        MachineCountryMade::destroy($machinecountrymadeID);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-country-made-table', [
            'country_made'=>MachineCountryMade::all(),
        ]);
    }
}
