<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\MakeList;

class MakeListTable extends Component
{
    public $makeListId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteMakeList',
    ];

    public function render()
    {
        return view('livewire.engine.make-list-table',[
            'makelists' => MakeList::all()->sortBy('id')
        ]);
    }

    public function createMakeList()
    {
        $this->emit('resetInputFields');
        $this->emit('openMakeListModal');
    }
    public function editMakeList($makeListId)
    {

        $this->makeListId = $makeListId;
        $this->emit('makeListId', $this->makeListId);
        $this->emit('openMakeListModal');
    }

    public function deleteconfirmMakeList($makeListId)
    {
        $this->dispatchBrowserEvent('swal:confirmMakeListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $makeListId
        ]);
    }

    public function deleteMakeList($makeListId)
    {
        // dd($clientTypeId);
        MakeList::destroy($makeListId);
        $this->reset();
    }
}
