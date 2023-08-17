<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class PermissionTable extends Component
{
    use WithPagination;

    public $permissionId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deletePermission',
    ];

    public function render()
    {
        return view('livewire.auth.permission-table', [
            'permissions' => Permission::all()
        ]);
    }

    public function createPermission()
    {
        $this->emit('resetInputFields');
        $this->emit('openPermissionModal');
    }


    public function editPermission($permissionId)
    {
        $this->permissionId = $permissionId;
        $this->emit('permissionId', $this->permissionId);
        $this->emit('openPermissionModal');
    }

    public function deleteConfirmPermission($permissionId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmPermissionDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $permissionId
        ]);
    }

    public function deletePermission($permissionId)
    {

        Permission::destroy($permissionId);
        $this->resetPage();
    }
}