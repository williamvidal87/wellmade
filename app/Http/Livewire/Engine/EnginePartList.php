<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\Engine_Parts;
use Livewire\WithPagination;

class EnginePartList extends Component
{

    public $engine_partsID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteEnginePartList',
    ];

    public function createEnginePartList()
    {
        $this->emit('resetInputFields');
        $this->emit('openEnginePartListModal');
    }
    public function editEnginePartList($engine_partsID)
    {

        $this->engine_partsID = $engine_partsID;
        $this->emit('enginepartlistID', $this->engine_partsID);
        $this->emit('openEnginePartListModal');
    }

    public function deleteConfirmEnginePartList($engine_partsID)
    {
        $this->dispatchBrowserEvent('swal:confirmEnginePartListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $engine_partsID
        ]);
    }
    public function render()
    {
        return view('livewire.engine.engine-part-list', [
            'engine_parts' => Engine_Parts::all()->sortBy('id')
        ]);
    }
    public function deleteEnginePartList($engine_partsID)
    {
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        Engine_Parts::destroy($engine_partsID);
        $this->reset();
    }
}