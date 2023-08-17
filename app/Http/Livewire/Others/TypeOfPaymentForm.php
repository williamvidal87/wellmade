<?php

namespace App\Http\Livewire\Others;

use Livewire\Component;
use App\Models\TypeOfPayment;

class TypeOfPaymentForm extends Component
{
    public  $Id, $payment_type;

    protected $listeners = [
        'Id',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function Id($id){      
        $this->Id = $id;     
        $payment = TypeOfPayment::find($id);
        $this->payment_type = $payment->payment_type;
    }

    public function render()
    {
        return view('livewire.others.type-of-payment-form');
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'payment_type' => 'required',
        ]);
        try
		{
            if($this->Id){
                TypeOfPayment::find($this->Id)->update($data);
            }else{
                TypeOfPayment::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->Id){
            $action = 'edit';
            $message = 'Record Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Record Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeModal');

    }
}
