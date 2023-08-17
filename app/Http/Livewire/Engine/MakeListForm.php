<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\MakeList;

class MakeListForm extends Component
{
    public $makeListId, $make_name, $action, $message;

    protected $listeners = [
        'makeListId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
    }

    public function makeListId($makeListId)
    {
        $this->makeListId = $makeListId;
        $lists = MakeList::find($makeListId);
        $this->make_name = $lists->make_name;
    }

    public function render()
    {
        return view('livewire.engine.make-list-form');
    }

    public function store()
    {

        $data = $this->validate([
            'make_name' => 'required',
        ]);

        try {
            if ($this->makeListId) {
                MakeList::find($this->makeListId)->update($data);
            } else {
                MakeList::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->makeListId) {
            $action = 'edit';
            $message = 'Engine Make List Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Engine Make List Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeMakeListModal');
    }
}
