<?php

namespace App\Http\Livewire\ComponentsParts;

use Livewire\Component;
use App\Models\Component_Parts;
use Livewire\WithPagination;

class ComponentPartsList extends Component
{
    use WithPagination;
    public $component_partsLISTId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteComponentPartsList'
    ];

    public function createComponentPartsList()
    {
        $this->emit('resetInputFields');
        $this->emit('openComponentPartsListModal');
    }
    public function editComponentPartsList($component_partsListId)
    {

        $this->component_partsLISTId = $component_partsListId;
        $this->emit('componentpartslistID', $this->component_partsLISTId);
        $this->emit('openComponentPartsListModal');
    }

    public function deleteConfirmComponentPartsList($component_partsListId)
    {
        $this->dispatchBrowserEvent('swal:confirmComponentPartsListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $component_partsListId
        ]);
    }
    public function render()
    {
        return view('livewire.components-parts.component-parts-list', [
            'component_parts' => Component_Parts::all()->sortBy('id')
        ]);
    }
    public function deleteComponentPartsList($component_partsListId)
    {

        Component_Parts::destroy($component_partsListId);
        $this->reset();
    }
}