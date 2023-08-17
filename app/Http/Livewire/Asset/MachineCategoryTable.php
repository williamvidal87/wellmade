<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineCategory;
use Livewire\Component;

class MachineCategoryTable extends Component
{
    public $machineCategoryId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
    ];

    public function createMachineCategory()
    {
        $this->emit('resetInputFields');
        $this->emit('openMachineCategoryModal');
    }

    public function editMachineCategory($id)
    {
        $this->machineCategoryId = $id;   
        // dd($this->machineCategoryId);
        $this->emit('editMachineCategoryId', $this->machineCategoryId);
        $this->emit('openMachineCategoryModal');
    }

    public function render()
    {
        return view('livewire.asset.machine-category-table',[
            'machine_category' => MachineCategory::all()
        ]);
    }

    public function deleteConfirmMachineCategory($id)
    {
        $this->dispatchBrowserEvent('swal:deleteConfirmMachineCategory', [
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
    public function delete($id){
        $action = 'delete';
        $message = ' ';
        // dd($action);
        $this->emit('flashAction',$action,$message);
    
        MachineCategory::destroy($id);
        $this->reset();
    }
}
