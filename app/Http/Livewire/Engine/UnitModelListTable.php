<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\UnitModelList;
use Livewire\WithPagination;


class UnitModelListTable extends Component
{
    use WithPagination;

    public $Id;
    public $action;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
       
    ];

    public function render()
    {
        return view('livewire.engine.unit-model-list-table',[
            'engine' => UnitModelList::all()
        ]);
    }

    public function create(){
        $this->emit('resetInputFields');
        $this->emit('openModal');
       
    }

    
    public function edit($Id){        
        $this->Id = $Id;
        $this->emit('Id',$this->Id);
        $this->emit('openModal');
    }

    public function deleteConfirm($Id){
       
        $this->dispatchBrowserEvent('swal:confirmDelete', [
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

    public function delete($Id){
        $action = 'delete';
        $message = ' ';
        // dd($action);
        $this->emit('flashAction',$action,$message);
    
        UnitModelList::destroy($Id);
        $this->resetPage();
    }

}
