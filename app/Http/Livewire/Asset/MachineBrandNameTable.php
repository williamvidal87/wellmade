<?php

namespace App\Http\Livewire\Asset;

use Livewire\Component;
use App\Models\MachineBrandName;
use Livewire\WithPagination;


class MachineBrandNameTable extends Component
{
    use WithPagination;
    public $machineBrandName, $brand_name;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachineBrandName',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachinebrandnamemodal');
    }

    public function edit($machineBrandName){

        $this->emit('machinebrandnameID', $machineBrandName);
        $this->emit('openmachinebrandnamemodal');
    }

    public function delete($machineBrandName){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachineBrandName', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machineBrandName
        ]);
    }

    public function deleteMachineBrandName($machineBrandName){

        MachineBrandName::destroy($machineBrandName);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-brand-name-table', [
            'brand_names'=> MachineBrandName::all(),
        ]);
    }
}
