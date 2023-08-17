<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineDescription;
use Livewire\Component;

class MachineDescriptionTable extends Component
{
   
   
    public $MachineDescriptionId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
    ];

    public function createMachineDescription()
    {
        $this->emit('reserInputFields');
        $this->emit('openMachineDescriptionModal');
    }

    public function editMachineDescription($id)
    {
        $this->MachineDescriptionId = $id;   
        // dd($this->MachineDescriptionId);
        $this->emit('editMachineDescriptionId', $this->MachineDescriptionId);
        $this->emit('openMachineDescriptionModal');
    }

    public function render()
    {
        $machinedescription = MachineDescription::select('id','machine_description_number_id','description')->with('getmachinedescriptionnumberid')->get();
        return view('livewire.asset.machine-description-table')
        ->with('machinedescription',$machinedescription);
    }
   

    public function deleteConfirmMachineDescription($id)
    {
        $this->dispatchBrowserEvent('swal:deleteConfirmMachineDescription', [
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
    
        MachineDescription::destroy($id);
        $this->reset();
    }
}
