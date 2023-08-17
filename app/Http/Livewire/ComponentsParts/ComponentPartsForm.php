<?php

namespace App\Http\Livewire\ComponentsParts;

use Livewire\Component;
use App\Models\Component_Parts;

class ComponentPartsForm extends Component
{
    public $componentpartsListID, $parts_name, $message, $action;

    protected $listeners = [
        'componentpartslistID',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function componentpartslistID($component_partsListId)
    {
        $this->componentpartsListID = $component_partsListId;
        $component_parts_List = Component_Parts::find($component_partsListId);
        $this->parts_name = $component_parts_List->parts_name;
    }
    public function render()
    {
        return view('livewire.components-parts.component-parts-form');
    }

    public function store()
    {
        $data = $this->validate([
            'parts_name' => 'required',
        ]);

        try {
            if ($this->componentpartsListID) {
                Component_Parts::find($this->componentpartsListID)->update($data);
            } else {
                Component_Parts::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->componentpartsListID) {
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
        $this->emit('closeComponentPartsListModal');
    }
}