<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\ProcessSubGroup;
use Livewire\WithPagination;

class ProcessSubGroupTable extends Component
{
    use WithPagination;

    public $processsubgroupId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deletePermission',
    ];

    public function render()
    {
        $processsubgroups = ProcessSubGroup::with('getGroups')->get();
        return view('livewire.workload.process-sub-group-table')->with('processsubgroups',$processsubgroups);
    }

    public function createProcessSubbGroup()
    {
        $this->emit('resetInputFields');
        $this->emit('openProcessSubGroupModal');
    }


    public function editProcessSubGroup($processsubgroupId)
    {
        $this->processsubgroupId = $processsubgroupId;
        $this->emit('processsubgroupId', $this->processsubgroupId);
        $this->emit('openProcessSubGroupModal');
    }

    public function deleteConfirmProcessSubGroup($processsubgroupId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmProcessSubGroupDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $processsubgroupId
        ]);
    }

    public function ProcessSubGroup($processsubgroupId)
    {

        ProcessSubGroup::destroy($processsubgroupId);
        $this->resetPage();
    }
}
