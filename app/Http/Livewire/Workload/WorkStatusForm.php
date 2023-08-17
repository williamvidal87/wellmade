<?php

namespace App\Http\Livewire\Workload;

use App\Models\WorkStatus;
use Livewire\Component;

class WorkStatusForm extends Component
{
    public $slug, $workstatusID, $work_status_type;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'workstatusID',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function workstatusID($workstatusID){
        $this->workstatusID = $workstatusID;
        $workstatus = WorkStatus::find($workstatusID);
        $this->work_status_type = $workstatus->work_status_type;
    }

    public function render()
    {
        return view('livewire.workload.work-status-form');
    }

    
    public function store(){

        $data = $this->validate([
            'work_status_type' => 'required',
        ]);

        try
		{
            if($this->workstatusID){
                WorkStatus::find($this->workstatusID)->update($data);
            }else{
                WorkStatus::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->workstatusID){
            $action = 'edit';
            $message = 'Work Status Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Work Status Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeWorkStatusModal');
    }   
}
