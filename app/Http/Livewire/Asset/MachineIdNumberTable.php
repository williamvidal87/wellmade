<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineIdNumber;
use Livewire\Component;

class MachineIdNumberTable extends Component
{
  
    public $machineNumberId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
    ];

    public function createMachineNumber()
    {
        $this->emit('openMachineNumberModal');
    }

    public function editMachineNumber($id)
    {
        $this->machineNumberId = $id;   
        // dd($this->machineNumberId);
        $this->emit('editMachineNumberId', $this->machineNumberId);
        $this->emit('openMachineNumberModal');
    }

    public function render()
    {
        return view('livewire.asset.machine-id-number-table', [
            "machine_number" => MachineIdNumber::all()
        ]);
    }

   

    public function deleteConfirmMachineNumber($id)
    {
        $this->dispatchBrowserEvent('swal:deleteConfirmMachineNumber', [
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
    
        MachineIdNumber::destroy($id);
        $this->reset();
    }
}
