<?php

namespace App\Http\Livewire\CRM;

use App\Models\ClientProfile;
use App\Models\DiscountPercentage;
use App\Models\InvoiceIssued;
use App\Models\PaymentType;
use Livewire\Component;

class PaymentForm extends Component
{

    public $invoice_issued_id, $discount_er, $discount_mf, $discount_spareparts, $discount_calib, $payment_type_id, $clientContactId;


    protected $listeners = [
        'paymentClientContactId',
        'resetInputFields',
    ];

    public function paymentClientContactId($clientContactId)
    {
        $this->clientContactId = $clientContactId;
        $clientContact = ClientProfile::find($clientContactId);
        $this->invoice_issued_id = $clientContact->invoice_issued_id;
        $this->discount_er = $clientContact->discount_er;
        $this->discount_mf = $clientContact->discount_mf;
        $this->discount_spareparts = $clientContact->discount_spareparts;
        $this->discount_calib = $clientContact->discount_calib;
        $this->payment_type_id = $clientContact->payment_type_id;
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function store()
    {

        $data = $this->validate([
            'invoice_issued_id' => 'nullable',
            'discount_er' => 'nullable',
            'discount_mf' => 'nullable',
            'discount_spareparts' => 'nullable',
            'discount_calib' => 'nullable',
            'payment_type_id' => 'nullable',
        ]);

        try {
            // dd($data);
            if ($this->clientContactId) {
                ClientProfile::find($this->clientContactId)->update($data);
            } else {
                // ClientProfile::create($data);
            }
        } catch (\Exception $e) {
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->clientContactId) {
            $action = 'edit';
            $message = 'Payment Info Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Client Contact Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closePaymentClientContactModal');
    }

    public function render()
    {
        return view('livewire.c-r-m.payment-form', [
            'invoice_issueds' => InvoiceIssued::all(),
            'discount_percentages' => DiscountPercentage::all(),
            'payment_types' => PaymentType::all(),
        ]);
    }
}
