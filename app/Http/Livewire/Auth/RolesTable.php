<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class RolesTable extends Component
{
    use WithPagination;

    public $roleId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteRole',
        'showEmitedFlashMessage'
    ];
    public function render()
    {
        return view('livewire.auth.roles-table',[
            'roles' => Role::all()->sortBy('id'),
        ]);
    }

    public function createRole(){
        $this->emit('resetInputFields');
        $this->emit('openRoleModal');
    }

    
    public function editRole($roleId){
        $this->roleId = $roleId;
        $this->emit('roleId',$this->roleId);
        $this->emit('openRoleModal');
    }

    public function setRolePermission($roleId){
        $this->roleId = $roleId;
        $this->emit('roleId',$this->roleId);
        $this->emit('openSetRoleModal');
    }

    public function deleteConfirmRole($roleId){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmRoleDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $roleId
        ]);
    }

    public function deleteRole($roleId){
        
        Role::destroy($roleId);
        $this->resetPage();
    }
}
