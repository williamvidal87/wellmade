<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachinePurchaseType;
use Livewire\Component;
use Livewire\WithPagination;

class MachinePurchaseTypeTable extends Component
{

    use WithPagination;
    public $machinepurchaseType, $machine_purchase_type_name;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachinePurchaseType',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachinepurchasetypemodal');
    }

    public function edit($id){

        $this->emit('machinePurchaseTypeID', $id);
        $this->emit('openmachinepurchasetypemodal');
    }

    public function delete($id){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachinePurchaseType', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $id
        ]);
    }

    public function deleteMachinePurchaseType($id){

        MachinePurchaseType::destroy($id);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-purchase-type-table', [
            'purchase_type' => MachinePurchaseType::all(),
        ]);
    }
}
