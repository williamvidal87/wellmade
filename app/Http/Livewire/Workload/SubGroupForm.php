<?php

namespace App\Http\Livewire\Workload;

use App\Models\JobTypes;
use Livewire\Component;
use App\Models\SubGroup;

class SubGroupForm extends Component
{
    public  $Id, $group_name ,$job_type_id;

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
        $workGroup = SubGroup::find($id);
        $this->job_type_id      = $workGroup->job_type_id;
        $this->group_name   = $workGroup->group_name;
    }

    public function render()
    {
        return view('livewire.workload.sub-group-form',[
            'jobtype' => JobTypes::all()
        ]);
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'job_type_id' => 'required',
            'group_name' => 'required',
        ]);
        try
		{
            if($this->Id){
                SubGroup::find($this->Id)->update($data);
            }else{
                SubGroup::create($data);
            }

		} catch (\Exception $e) {
			dd($e);
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
