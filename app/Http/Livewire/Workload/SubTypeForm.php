<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\SubType;

class SubTypeForm extends Component
{
    public $slug, $subtypeId, $sub_type_name;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'subtypeId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function subtypeId($subtypeId)
    {
        $this->subtypeId = $subtypeId;
        $permission = SubType::find($subtypeId);
        $this->sub_type_name = $permission->sub_type_name;
    }

    public function render()
    {
        return view('livewire.workload.sub-type-form');
    }


    public function store()
    {

        $data = $this->validate([
            'sub_type_name' => 'required',
        ]);

        $data['guard_name'] = 'web';

        try {
            if ($this->subtypeId) {
                SubType::find($this->subtypeId)->update($data);
            } else {
                SubType::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->subtypeId) {
            $action = 'edit';
            $message = 'Sub Type Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Sub Type Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closesubtypeModal');
    }
}
