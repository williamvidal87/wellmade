<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\SubGroupRates;
use Livewire\WithPagination;

class SubGroupRateTable extends Component
{
    use WithPagination;

    public $subgrouprateId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteSubgrouprate',
    ];

    public function render()
    {
        $subgrouprate = SubGroupRates::with('getGroup')->get();
        //  dd($subgrouprate);
            return view('livewire.workload.sub-group-rate-table')
            ->with('subgrouprate',$subgrouprate)
            ->with('getSubGroup');
    }

    public function createSubgrouprate()
    {
        $this->emit('resetInputFields');
        $this->emit('openSubgroupratenModal');
    }


    public function editSubgrouprate($subgrouprateId)
    {
        $this->subgrouprateId = $subgrouprateId;
        $this->emit('subgrouprateId', $this->subgrouprateId);
        $this->emit('openSubgroupratenModal');
    }

    public function deleteConfirmSubgrouprate($subgrouprateId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmSubgrouprateDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $subgrouprateId
        ]);
    }

    public function deleteSubgrouprate($subgrouprateId)
    {

        SubGroupRates::destroy($subgrouprateId);
        $this->resetPage();
    }
}
