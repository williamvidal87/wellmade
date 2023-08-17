<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\ScopeDescription;
use Livewire\WithPagination;

class ScopeDescriptionTable extends Component
{
    use WithPagination;

    public $scopedescriptionId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteScopeDescription',
    ];

    public function render()
    {
        $scopedescriptions = ScopeDescription::with('getSubTypes','getGeneralProcedure')->get();
        return view('livewire.workload.scope-description-table')->with('scopedescriptions',$scopedescriptions);
    }

    public function createScopeDescription()
    {
        $this->emit('resetInputFields');
        $this->emit('openScopeDescriptionModal');
    }   

    public function editScopeDescription($scopedescriptionId)
    {
        $this->scopedescriptionId = $scopedescriptionId;
        $this->emit('scopedescriptionId', $this->scopedescriptionId);
        $this->emit('openScopeDescriptionModal');       
    }   

    public function deleteConfirmScopeDescription($scopedescriptionId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmScopeDescriptionDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $scopedescriptionId
        ]);
    }

    public function deleteScopeDescription($scopedescriptionId)
    {

        ScopeDescription::destroy($scopedescriptionId);
        $this->resetPage();
    }
}
