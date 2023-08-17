<?php

namespace App\Http\Livewire\Workload;

use App\Models\JobTypes;
use Livewire\Component;
use App\Models\WorkSubType;

class WorkSubTypeForm extends Component
{   
    public $work_sub_type_name,$job_type_id;
    public  $Id;          //edit
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'Id',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
    }

    //edit
    public function Id($id){      
        $this->Id = $id;     
        $workGroup = WorkSubType::find($id);
        $this->work_sub_type_name = $workGroup->work_sub_type_name;
        $this->job_type_id = $workGroup->job_type_id;
    }
   
    public function render()
    {
        return view('livewire.workload.work-sub-type-form',[
            'jobtypes' => JobTypes::all()
        ]);
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'work_sub_type_name' => 'required',
            'job_type_id' => 'required',
        ]);
        try
		{
            if($this->Id){
                WorkSubType::find($this->Id)->update($data);
            }else{
                WorkSubType::create($data);
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
