<?php

namespace App\Http\Livewire\client;

use App\Models\CsaType;
use Livewire\Component;

class CsaTypeForm extends Component
{

    public $csa_type, $csaTypeId;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'csaTypeId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function csaTypeId($csaTypeId)
    {
        $this->csaTypeId = $csaTypeId;
        $csaType = CsaType::find($csaTypeId);
        $this->csa_type = $csaType->csa_type;
    }

    public function store()
    {

        $data = $this->validate([
            'csa_type' => 'required',
        ]);

        try {
            if ($this->csaTypeId) {
                CsaType::find($this->csaTypeId)->update($data);
            } else {
                CsaType::create($data);
            }
        } catch (\Exception $e) {
            return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
        }

        if ($this->csaTypeId) {
            $action = 'edit';
            $message = 'Csa Type Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Csa Type Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeCsaTypeModal');
    }

    public function render()
    {
        return view('livewire.client.csa-type-form');
    }
}
