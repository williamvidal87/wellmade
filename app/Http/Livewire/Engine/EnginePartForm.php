<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\Engine_Parts;

class EnginePartForm extends Component
{
    public $enginepartListID, $engine_part_name, $action, $message;

    protected $listeners = [
        'enginepartlistID',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function enginepartlistID($engine_partsListId)
    {
        $this->enginepartListID = $engine_partsListId;
        $engine_part_List = Engine_Parts::find($engine_partsListId);
        $this->engine_part_name = $engine_part_List->engine_part_name;
    }
    public function render()
    {
        return view('livewire.engine.engine-part-form');
    }

    public function store()
    {

        $data = $this->validate([
            'engine_part_name' => 'required',
        ]);

        try {
            if ($this->enginepartListID) {
                Engine_Parts::find($this->enginepartListID)->update($data);
            } else {
                Engine_Parts::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->enginepartListID) {
            $action = 'edit';
            $message = 'Engine Part Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Engine Part Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeEnginePartListModal');
    }
}