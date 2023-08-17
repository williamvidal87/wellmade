<?php

namespace App\Http\Livewire\Engine;

use App\Models\EngineModel;
use Livewire\Component;

use Livewire\WithPagination;

class EngineModelTable extends Component
{

    use WithPagination;

    public $enginemodelID ;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteEngineModel',
    ];
    
    public function render()
    {
        $enginemodel = EngineModel::with('getYearMade','getMake','getCategory','getCylinder','getValve')->get();
        
        return view('livewire.engine.engine-model-table')
        ->with('enginemodel',$enginemodel);
    }

    public function createEngineModel(){
        $this->emit('resetInputFields');
        $this->emit('openEngineModelModal');
    }

    
    public function editEngineModel($enginemodelID){
        $this->enginemodelID = $enginemodelID;
        $this->emit('enginemodelID',$this->enginemodelID);
        $this->emit('openEngineModelModal');
    }

    public function deleteConfirmEngineModel($enginemodelID){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmEngineModelDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $enginemodelID
        ]);
    }

    public function deleteEngineModel($enginemodelID){
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        EngineModel::destroy($enginemodelID);
        $this->resetPage();
    }
    
}