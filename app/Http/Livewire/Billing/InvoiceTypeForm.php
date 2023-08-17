<?php

namespace App\Http\Livewire\Billing;

use App\Models\InvoiceTypes;
use Livewire\Component;

class InvoiceTypeForm extends Component
{
    public $slug, $invoicetypeID, $invoice_type;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'invoicetypeID',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function invoicetypeID($invoicetypeID){
        $this->invoicetypeID = $invoicetypeID;
        $workstatus = InvoiceTypes::find($invoicetypeID);
        $this->invoice_type = $workstatus->invoice_type;
    }

    public function render()
    {
        return view('livewire.billing.invoice-type-form');
    }

    
    public function store(){

        $data = $this->validate([
            'invoice_type' => 'required',
        ]);

        try
		{
            if($this->invoicetypeID){
                InvoiceTypes::find($this->invoicetypeID)->update($data);
            }else{
                InvoiceTypes::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->invoicetypeID){
            $action = 'edit';
            $message = 'Invoice Types Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Invoice Types Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeInvoiceTypeModal');
    }
}
