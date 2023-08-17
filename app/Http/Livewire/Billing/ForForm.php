<?php

namespace App\Http\Livewire\Billing;

use App\Models\TransactionFor;
use Livewire\Component;

class ForForm extends Component
{

    public $type, $forId;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'forId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    //edit
    public function forId($forId)
    {
        $this->forId = $forId;
        $for = TransactionFor::find($forId);
        $this->type = $for->type;
    }

    public function store()
    {

        $data = $this->validate([
            'type' => 'required',
        ]);

        try {
            if ($this->forId) {
                TransactionFor::find($this->forId)->update($data);
            } else {
                TransactionFor::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->forId) {
            $action = 'edit';
            $message = 'For Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'For Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeForModal');
    }

    public function render()
    {
        return view('livewire.billing.for-form');
    }
}
