<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\CylinderList;
use App\Models\MakeList;

class CylinderListForm extends Component
{
    public $cylinderId, $cylinder, $action, $message;

    protected $listeners = [
        'cylinderId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
    }

    public function cylinderId($cylinderId)
    {
        $this->cylinderId = $cylinderId;
        $lists = CylinderList::find($cylinderId);
        $this->cylinder = $lists->cylinder;
    }

    public function render()
    {
        return view('livewire.engine.cylinder-list-form',[
            'makelist' => MakeList::all()
        ]);
    }

    public function store()
    {

        $data = $this->validate([
            'cylinder' => 'required|integer',
        ]);
        // dd($data);
        try {
            if ($this->cylinderId) {
                CylinderList::find($this->cylinderId)->update($data);
            } else {
                // dd($data);
                CylinderList::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->cylinderId) {
            $action = 'edit';
            $message = 'Cylinder List Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Cylinder List Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeCylinderListModal');
    }
}
