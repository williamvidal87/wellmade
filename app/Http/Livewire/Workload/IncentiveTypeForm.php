<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\IncentiveType;

class IncentiveTypeForm extends Component
{
    public  $Id, $incentive_type_name;
    public $action = '';  //flash
    public $message = '';  //flash

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
        $workGroup = IncentiveType::find($id);
        $this->incentive_type_name = $workGroup->incentive_type_name;
    }

    public function render()
    {
        return view('livewire.workload.incentive-type-form');
    }

    public function store(){

        $action = '';       

        $data = $this->validate([
            'incentive_type_name' => 'required',
        ]);
        try
		{
            if($this->Id){
                IncentiveType::find($this->Id)->update($data);
            }else{
                IncentiveType::create($data);
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
