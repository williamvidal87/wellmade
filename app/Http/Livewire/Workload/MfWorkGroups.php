<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\MfWorkGroup;
use Livewire\WithPagination;

class MfWorkGroups extends Component
{   use WithPagination;
    
    public $Id;
    

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
       
    ];

   
    public function render()
    {
        return view('livewire.workload.mf-work-groups',[
            'workGroup' => MfWorkGroup::all()
        ]);
    }

   
   
    public function create(){
        $this->emit('resetInputFields');
        $this->emit('openModal');
    }

    
    public function edit($id){
       
        $this->Id = $id;
        $this->emit('Id',$this->Id);
        $this->emit('openModal');
    }

    public function deleteConfirm($id){
        
        $this->dispatchBrowserEvent('swal:confirmDelete', [
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
        
        MfWorkGroup::destroy($id);
        $this->resetPage();
    }
}
