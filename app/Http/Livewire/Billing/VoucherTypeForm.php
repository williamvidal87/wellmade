<?php

namespace App\Http\Livewire\Billing;

use App\Models\VoucherType;
use Livewire\Component;

class VoucherTypeForm extends Component
{

    public $type, $voucherTypeId;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'voucherTypeId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function voucherTypeId($voucherTypeId)
    {
        $this->voucherTypeId = $voucherTypeId;
        $voucher = VoucherType::find($voucherTypeId);
        $this->type = $voucher->type;
    }

    public function store()
    {

        $data = $this->validate([
            'type' => 'required',
        ]);

        try {
            if ($this->voucherTypeId) {
                VoucherType::find($this->voucherTypeId)->update($data);
            } else {
                VoucherType::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->voucherTypeId) {
            $action = 'edit';
            $message = 'Voucher Type Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Voucher Type Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeVoucherTypeModal');
    }


    public function render()
    {
        return view('livewire.billing.voucher-type-form');
    }
}
