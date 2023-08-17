<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachinePurchaseFrom;
use Livewire\Component;
use Livewire\WithPagination;

class MachinePurchaseFromTable extends Component
{
    use WithPagination;
    public $machinePurchaseForms, $machine_brand_name;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMachinePurchaseFrom',
    ];

    public function create(){

        $this->emit('resetInputFields');
        $this->emit('openmachinepurchasefrommodal');
    }

    public function edit($purchasefromID){

        $this->emit('machinePurchaseFromID', $purchasefromID);
        $this->emit('openmachinepurchasefrommodal');
    }

    public function delete($purchasefromID){

        $this->dispatchBrowserEvent('swal:deleteConfirmMachinePurchaseFrom', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $purchasefromID
        ]);
    }

    public function deleteMachinePurchaseFrom($purchasefromID){

        MachinePurchaseFrom::destroy($purchasefromID);
        $this->reset();

    }

    public function render()
    {
        return view('livewire.asset.machine-purchase-from-table', [
            'purchase_from' => MachinePurchaseFrom::all(),
        ]);
    }
}
