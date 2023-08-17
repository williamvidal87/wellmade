<?php

namespace App\Http\Livewire\client;

use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;

class BranchTable extends Component
{

    use WithPagination;

    public $branchId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteBranch'
    ];


    public function showEmitedFlashMessage($action)
    {
        // dd($action);

        $this->action = $action;
        $this->emit('flashAction', $this->action);
    }

    public function createBranch()
    {
        $this->emit('resetInputFields');
        $this->emit('openBranchModal');
    }


    public function editBranch($branchId)
    {
        $this->branchId = $branchId;
        $this->emit('branchId', $this->branchId);
        $this->emit('openBranchModal');
    }

    public function deleteConfirmBranch($branchId)
    {
        // dd($clientTypeId);
        // $this->dispatchBrow  serEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmBranchDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $branchId
        ]);
    }

    public function deleteBranch($branchId)
    {
        // dd($clientTypeId);
        Branch::destroy($branchId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.client.branch-table', [
            'branches' => Branch::all(),
        ]);
    }
}
