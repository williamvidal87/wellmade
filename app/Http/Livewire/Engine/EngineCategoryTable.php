<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\EngineCategory;
use Livewire\WithPagination;

class EngineCategoryTable extends Component
{
    
    use WithPagination;

    public $enginecategoryID ;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteEngineCategory',
    ];
    
    public function render()
    {
        return view('livewire.engine.engine-category-table',[
            'enginecategory' => EngineCategory::all()
        ]);
    }

    public function createEngineCategory(){
        $this->emit('resetInputFields');
        $this->emit('openEngineCategoryModal');
    }

    
    public function editEngineCategory($enginecategoryID){
        $this->enginecategoryID = $enginecategoryID;
        $this->emit('enginecategoryID',$this->enginecategoryID);
        $this->emit('openEngineCategoryModal');
    }

    public function deleteConfirmEngineCategory($enginecategoryID){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmEngineCategoryDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $enginecategoryID
        ]);
    }

    public function deleteEngineCategory($enginecategoryID){
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        EngineCategory::destroy($enginecategoryID);
        $this->resetPage();
    }

   
}
