<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\ProcessGroup;
use Livewire\WithPagination;


class ProcessGroupTable extends Component
{
    public $Id;
    use WithPagination;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteProcessGroup'
    ];
    
    public function render()
    {
        return view('livewire.workload.process-group-table',[
            'workGroup' => ProcessGroup::all()
        ]);
    } 

    public function createProcessGroup()
    {
        $this->emit('resetInputFields');
        $this->emit('openProcessGroupModal');
    }
    public function editProcessGroup($Id)
    {

        $this->Id = $Id;
        $this->emit('Id', $this->Id);
        $this->emit('openProcessGroupModal');
    }

    public function deleteConfirmProcessGroup($Id)
    {
        $this->dispatchBrowserEvent('swal:confirmProcessGroupDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $Id
        ]);
    }

    public function deleteProcessGroup($id){   
        $action = 'delete';
            $message = ' ';
            $this->emit('flashAction',$action,$message);
            
        ProcessGroup::destroy($id);
        $this->resetPage();
    }

    
}
