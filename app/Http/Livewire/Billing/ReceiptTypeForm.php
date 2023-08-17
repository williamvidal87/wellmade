<?php

namespace App\Http\Livewire\Billing;

use App\Models\ReceiptTypes;
use Livewire\Component;

class ReceiptTypeForm extends Component
{

    public $receipt_type, $receiptTypeId;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'receiptTypeId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    //edit
    public function receiptTypeId($receiptTypeId)
    {
        $this->receiptTypeId = $receiptTypeId;
        $receiptType = ReceiptTypes::find($receiptTypeId);
        $this->receipt_type = $receiptType->receipt_type;
    }

    public function store()
    {

        $data = $this->validate([
            'receipt_type' => 'required',
        ]);

        try {
            if ($this->receiptTypeId) {
                ReceiptTypes::find($this->receiptTypeId)->update($data);
            } else {
                ReceiptTypes::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->receiptTypeId) {
            $action = 'edit';
            $message = 'Receipt Type Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Receipt Type Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeReceiptTypeModal');
    }

    public function render()
    {
        return view('livewire.billing.receipt-type-form');
    }
}
