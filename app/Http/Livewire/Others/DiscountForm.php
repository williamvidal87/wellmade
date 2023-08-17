<?php

namespace App\Http\Livewire\Others;

use Livewire\Component;
use App\Models\Discount;

class DiscountForm extends Component
{
    public  $Id, $discount;

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
        $discounts = Discount::find($id);
        $this->discount = number_format($discounts->discount);
    }

    public function render()
    {
        return view('livewire.others.discount-form');
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'discount' => 'required|numeric',
        ]);
        try
		{
           
            if($this->Id){
                Discount::find($this->Id)->update($data);
            }else{
                Discount::create($data);
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
