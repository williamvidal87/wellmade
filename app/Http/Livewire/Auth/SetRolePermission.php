<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SetRolePermission extends Component
{
    public $slug, $roleId, $name;
    public $action = '';
    public $message = '';

    public $permissions = [];
    public $selectedRoles = [];

    protected $listeners = [
        'roleId',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function roleId($roleId){
        $this->roleId = $roleId;
        $roles = Role::find($roleId);
        $this->name = $roles->name;
        $this->selectedRoles = array_map('strval' ,json_decode($roles->permissions->pluck('id')));
    }

    public function render()
    {
        $permissions = Permission::all();
        return view('livewire.auth.set-role-permission',[
            'perms' => $permissions
        ]);
    }

    

    public function store(){

        if(empty($this->permissions)){
            $this->permissions = array_map('strval', $this->selectedRoles);
        }

        $data = $this->validate([
            'name' => 'required',
        ]);

        try
		{
            if($this->roleId){
                $role = Role::find($this->roleId);
                $role->update($data);
                $role->syncPermissions($this->permissions);
            }else{
                Role::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}


        if($this->roleId){
            $action = 'edit';
            $message = 'Roles Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Roles Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeRoleModal');
        $this->emit('closeSetRoleModal');

    }
}
