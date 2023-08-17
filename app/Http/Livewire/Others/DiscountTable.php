<?php

namespace App\Http\Livewire\Others;

use Livewire\Component;
use App\Models\Discount;
use Livewire\WithPagination;

class DiscountTable extends Component
{
    use WithPagination;

    public $Id;   
    // public $action;
    
    

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
       
    ];

    public function render()
    {
        return view('livewire.others.discount-table',[
            'discount' => Discount::all()
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
        Discount::destroy($id);
        $this->resetPage();
    }
}
