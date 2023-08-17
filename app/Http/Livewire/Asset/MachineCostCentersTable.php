<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineCostCenter;
use Livewire\Component;
use Livewire\WithPagination;

class MachineCostCentersTable extends Component
{
    use WithPagination;
    public $machineCostCenter;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachineCostCenters',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachinecostcentersmodal');
    }

    public function edit($machineconstcenters){

        $this->emit('machinecostcentersID', $machineconstcenters);
        $this->emit('openmachinecostcentersmodal');
    }

    public function delete($machineconstcenters){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachineCostCenters', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $machineconstcenters
        ]);
    }

    public function deleteMachineCostCenters($machineBrandName){

        MachineCostCenter::destroy($machineBrandName);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-cost-centers-table', [
            'cost_center_name'=>MachineCostCenter::all(),
        ]);
    }
}
