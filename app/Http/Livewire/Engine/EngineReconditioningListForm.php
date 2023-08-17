<?php

namespace App\Http\Livewire\Engine;

use App\Models\Engine_Reconditioning;
use Livewire\Component;

class EngineReconditioningListForm extends Component
{
    public $engine_reconditioningID, $eng_recon_name, $action, $message;

    protected $listeners = [
        'enginereconditioningID',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function enginereconditioningID($engine_recon_id)
    {
        $this->engine_reconditioningID = $engine_recon_id;
        $eng_recon_List = Engine_Reconditioning::find($engine_recon_id);
        $this->eng_recon_name = $eng_recon_List->eng_recon_name;
    }

    public function render()
    {
        return view('livewire.engine.engine-reconditioning-list-form');
    }

    public function store()
    {

        $data = $this->validate([
            'eng_recon_name' => 'required',
        ]);

        try {
            if ($this->engine_reconditioningID) {
                Engine_Reconditioning::find($this->engine_reconditioningID)->update($data);
            } else {
                Engine_Reconditioning::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->engine_reconditioningID) {
            $action = 'edit';
            $message = 'Engine Reconditioning Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Engine Reconditioning Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeEngineReconditioningListModal');
    }
}