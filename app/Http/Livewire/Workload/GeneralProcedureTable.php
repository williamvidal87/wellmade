<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\GeneralProcedure;
use Livewire\WithPagination;

class GeneralProcedureTable extends Component
{
    use WithPagination;

    public $Id;
   

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
        
    ];

    public function render()
    {
        $workGroup = GeneralProcedure::with('getGroups','getSubType')->get();
        return view('livewire.workload.general-procedure-table')->with('workGroup',$workGroup);
    }

   
    public function create(){
        $this->emit('resetInputFields');
        $this->emit('openModal');
    }

    
    public function edit($id){
        // dd($Id);
        $this->Id = $id;
        $this->emit('Id',$this->Id);
        $this->emit('openModal');
    }

    public function deleteConfirm($id){
       
        // $this->dispatchBrow  serEvent(event('swal:confirmCotactDelete'));
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
        GeneralProcedure::destroy($id);
        $this->resetPage();
    }
}
