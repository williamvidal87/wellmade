<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\GeneralProcedure;
use App\Models\SubGroup;
use App\Models\SubGroupRates;

class GeneralProcedureForm extends Component
{
    public  $Id, $groups_id, $work_sub_type_id, $general_procedure_name;
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
        $workGroup = GeneralProcedure::find($id);
        $this->groups_id                = $workGroup->groups_id;
        $this->work_sub_type_id         = $workGroup->work_sub_type_id;
        $this->general_procedure_name   = $workGroup->general_procedure_name;
    }
    
    public function render()
    {
        return view('livewire.workload.general-procedure-form',[
            'groups'    => SubGroup::all(),
            'worksubtype'    => SubGroupRates::all()
        ]);
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'groups_id' => '',
            'work_sub_type_id' => 'required',
            'general_procedure_name' => 'required',
        ]);
        try
		{
            if($this->Id){
                GeneralProcedure::find($this->Id)->update($data);
            }else{
                GeneralProcedure::create($data);
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
