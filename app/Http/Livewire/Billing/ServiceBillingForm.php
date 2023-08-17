<?php

namespace App\Http\Livewire\Billing;

use App\Models\CashCharge;
use App\Models\job_orders;
use App\Models\JobOrder;
use App\Models\ServiceBilling;
use App\Models\TypeOfPayment;
use Livewire\Component;

class ServiceBillingForm extends Component
{

    public $date, $reference_no, $jo_no, $customer_name, $address, $contact_no, $job_type, $description, $total_bill, $payment_type, $serviceBillingId, $cash_charge, $term_of_payment;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'serviceBillingId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    //edit
    public function serviceBillingId($serviceBillingId)
    {
        $this->serviceBillingId = $serviceBillingId;
        $serviceBilling = ServiceBilling::find($serviceBillingId);
        $this->date = $serviceBilling->date;
        $this->reference_no = $serviceBilling->reference_no;
        $this->jo_no = $serviceBilling->jo_no;
        $this->customer_name = $serviceBilling->customer_name;
        $this->address = $serviceBilling->address;
        $this->contact_no = $serviceBilling->contact_no;
        $this->job_type = $serviceBilling->job_type;
        $this->description = $serviceBilling->description;
        $this->total_bill = $serviceBilling->total_bill;
        $this->payment_type = $serviceBilling->payment_type;
    }

    public function store()
    {
        // dd("Hello");
        // $data = $this->validate([
        //     'date' => 'required',
        //     'reference_no' => 'required',
        //     'jo_no' => 'required',
        //     'customer_name' => 'required',
        //     'address' => 'required',
        //     'contact_no' => 'required',
        //     'job_type' => 'required',
        //     'description' => 'required',
        //     'total_bill' => 'required',
        //     'payment_type' => 'required',
        // ]);

        // try {
        //     if ($this->serviceBillingId) {
        //         ServiceBilling::find($this->serviceBillingId)->update($data);
        //     } else {
        //         ServiceBilling::create($data);
        //     }
        // } catch (\Exception $e) {
        //     return back();
        //     $action = 'error';
        //     $this->emit('flashAction',$action,$data);
        // }

        // if ($this->serviceBillingId) {
        //     $action = 'edit';
        //     $message = 'Service Billing Successfully Updated';
        //     // dd($action);
        //     $this->emit('flashAction', $action, $message);
        // } else {
        //     $action = 'store';
        //     $message = 'Service Billing Successfully Saved';
        //     // dd($action);
        //     $this->emit('flashAction', $action, $message);
        // }

        // $this->resetInputFields();
        // $this->emit('refreshParent');
        // $this->emit('closeServiceBillingModal');
    }

    public function render()
    {
        return view('livewire.billing.service-billing-form', [
            'job_order' => JobOrder::all(),
            // 'payment_types' => TypeOfPayment::all(),
            'cash_charges' => CashCharge::all(),
            'term_of_payments' => TypeOfPayment::all(),
        ]);
    }
}
