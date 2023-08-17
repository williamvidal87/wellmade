<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class RolesForm extends Component
{
    public  $roleId, $name;
    public $action = '';
    public $message = '';
    
    public $ottPlatform = '';
 
    public $webseries = [
        'Wanda Vision',
        'Money Heist',
        'Lucifer',
        'Stranger Things'
    ];   

    protected $listeners = [
        'roleId',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function roleId($roleId){
        $this->roleId = $roleId;
        // dd($this->roleId);
        $roles = Role::find($roleId);
        $this->name = $roles->name;
    }
    public function render()
    {
        return view('livewire.auth.roles-form');
    }

    public function closeModal(){
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeRoleModal');
    }

    public function store(){

        
        $data = $this->validate([
            'name' => 'required',
        ]);

        $data['guard_name'] = 'web';

        try
		{
            if($this->roleId){
                Role::find($this->roleId)->update($data);
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

    }
}
