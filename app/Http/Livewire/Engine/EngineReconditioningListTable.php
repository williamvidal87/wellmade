<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\Engine_Reconditioning;
use Livewire\WithPagination;

class EngineReconditioningListTable extends Component
{
    use WithPagination;
    public $engine_reconditioningID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteEngineReconditioningItem'
    ];

    public function editEngineReconditioningList($engine_recon_id)
    {
        $this->engine_reconditioningID = $engine_recon_id;
        $this->emit('enginereconditioningID', $this->engine_reconditioningID);
        $this->emit('openEngineReconditioningModal');
    }

    public function deleteconfirmEngineReconditioninglist($engine_recon_id)
    {
        $this->dispatchBrowserEvent('swal:deleteConfirmEngineReconditioningList', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $engine_recon_id
        ]);
    }

    public function render()
    {
        return view('livewire.engine.engine-reconditioning-list-table', [
            'eng_recon_list' => Engine_Reconditioning::all()->sortBy('id')
        ]);
    }

    public function createEngineReconditioningList()
    {
        $this->emit('resetInputFields');
        $this->emit('openEngineReconditioningModal');
    }

    public function deleteEngineReconditioningItem($engine_recon_id)
    {
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        
        Engine_Reconditioning::destroy($engine_recon_id);
        $this->reset();
    }
}