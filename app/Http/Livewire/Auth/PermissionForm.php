<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionForm extends Component
{
    public $slug, $permissionId, $name;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'permissionId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function permissionId($permissionId)
    {
        $this->permissionId = $permissionId;
        $permission = Permission::find($permissionId);
        $this->name = $permission->name;
    }

    public function render()
    {
        return view('livewire.auth.permission-form');
    }


    public function store()
    {

        $data = $this->validate([
            'name' => 'required',
        ]);

        $data['guard_name'] = 'web';

        try {
            if ($this->permissionId) {
                Permission::find($this->permissionId)->update($data);
            } else {
                Permission::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->permissionId) {
            $action = 'edit';
            $message = 'Permission Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Permission Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closePermissionModal');
    }
}