<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\ErWorkGroup;

class ErWorkGroupForm extends Component
{
    public  $Id, $er_work_group_name;
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
        $workGroup = ErWorkGroup::find($id);
        $this->er_work_group_name = $workGroup->er_work_group_name;
    }

   

    public function render()
    {
        return view('livewire.workload.er-work-group-form');
    }

    public function store(){

        $action = '';       

        $data = $this->validate([
            'er_work_group_name' => 'required',
        ]);
        try
		{
            if($this->Id){
                ErWorkGroup::find($this->Id)->update($data);
            }else{
                ErWorkGroup::create($data);
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
