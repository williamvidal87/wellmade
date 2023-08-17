<?php

namespace App\Http\Livewire\Billing;

use App\Models\ReceiptFor;
use Livewire\Component;

class ReceiptForForm extends Component
{

    public $type, $receiptForId;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'receiptForId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    //edit
    public function receiptForId($receiptForId)
    {
        $this->receiptForId = $receiptForId;
        $receiptFor = ReceiptFor::find($receiptForId);
        $this->type = $receiptFor->type;
    }

    public function store()
    {

        $data = $this->validate([
            'type' => 'required',
        ]);

        try {
            if ($this->receiptForId) {
                ReceiptFor::find($this->receiptForId)->update($data);
            } else {
                ReceiptFor::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->receiptForId) {
            $action = 'edit';
            $message = 'Receipt For Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Receipt For Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeReceiptForModal');
    }

    public function render()
    {
        return view('livewire.billing.receipt-for-form');
    }
}
