<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\CylinderList;

class CylinderListTable extends Component
{
    public $cylinderId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteCylinderList',
    ];

    public function render()
    {
        return view('livewire.engine.cylinder-list-table',[
        'cylinders' => CylinderList::all()
        ]);
    }

    public function createCylinderList()
    {
        $this->emit('resetInputFields');
        $this->emit('openCylinderListModal');
    }
    public function editCylinderList($cylinderId)
    {

        $this->cylinderId = $cylinderId;
        $this->emit('cylinderId', $this->cylinderId);
        $this->emit('openCylinderListModal');
    }

    public function deleteconfirmCylinderList($cylinderId)
    {
        $this->dispatchBrowserEvent('swal:confirmCylinderListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $cylinderId
        ]);
    }

    public function deleteCylinderList($cylinderId)
    {
        // dd($clientTypeId);
        CylinderList::destroy($cylinderId);
        $this->reset();
    }
}
