<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\Scopes;
use Livewire\WithPagination;

class ScopeTable extends Component
{
    public $scopeID;
    use WithPagination;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteScopeList',
    ];

    public function createScopeList()
    {
        $this->emit('resetInputFields');
        $this->emit('openScopeListModal');
    }
    public function editScopeList($scopeID)
    {

        $this->scopeID = $scopeID;
        $this->emit('scopeID', $this->scopeID);
        $this->emit('openScopeListModal');
    }

    public function deleteConfirmScopeList($scopeID)
    {
        $this->dispatchBrowserEvent('swal:confirmScopeListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $scopeID
        ]);
    }

    public function render()
    {
        return view('livewire.workload.scope-table', [
            'scopes' => Scopes::all()->sortBy('id')
        ]);
    }

    public function deleteScopeList($scopeID)
    {   $action = 'delete';
        $message = ' ';
        // dd($action);
        $this->emit('flashAction',$action,$message);
        Scopes::destroy($scopeID);
        $this->reset();
    }
}