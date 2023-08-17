<?php

namespace App\Http\Livewire\Workorder;

use App\Models\AddWorker;
use App\Models\JobOrder;
use App\Models\Percent;
use App\Models\User;
use App\Models\WorkOrder;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class WorkerForm extends Component
{
    public  $work_order_id,
            $assigned_worker_id,
            $percent_id,
            $parts_percent_id,
            $allot_hours;
            
    public $worker_Id;           //edit
    public $action2 = '';  //flash
    public $message2 = '';  //flash
    
    protected $listeners = [
        'worker_Id',
        'work_order_id',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function worker_Id($worker_Id){
        $this->worker_Id = $worker_Id;
        $worker = AddWorker::find($worker_Id);
        $this->work_order_id        = $worker->work_order_id;
        $this->assigned_worker_id   = $worker->assigned_worker_id;
        $this->percent_id           = $worker->percent_id;
        $this->parts_percent_id     = $worker->parts_percent_id;
        $this->allot_hours          = $worker->allot_hours;
    }

    public function render()
    {
        $worker=Role::whereId(7)->get();
        foreach($worker as $worker_id)
        {
            $worker_id;
        }
        return view('livewire.workorder.worker-form',[
            'worker'=>User::role($worker_id->name)->get(),
            'percent'=>Percent::all(),
            'part_percent'=>Percent::all(),
        ]);
        
    }
    
    public function closeAddFormWorker(){
        $this->resetInputFields();
    }
    
    public function work_order_id($work_order_id){
        $this->work_order_id=$work_order_id;
    }
    
    
    public function store(){

        $data = $this->validate([
            'work_order_id' => '',
            'assigned_worker_id' => 'required',
            'percent_id' => 'required',
            'parts_percent_id' => 'required',
            'allot_hours' => 'required',
        ]);

        $data['work_order_id']=$this->work_order_id;
        $data['status'] = 6;
        
        try
		{
            if($this->worker_Id){
                AddWorker::find($this->worker_Id)->update($data);
            }else{
                AddWorker::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action2 = 'error';
            $this->emit('flashActionModal2',$action2,$data);
		}

        if($this->worker_Id){
            $action2 = 'edit';
            $message2 = 'Worker Successfully Updated';
            // dd($action2);
            $this->emit('flashActionModal2',$action2,$message2);
        }
        else{
            
            $check_jo_no=WorkOrder::Where('id',$this->work_order_id)->get()->first();
            $show_jo_no_id = JobOrder::Where('id',$check_jo_no['jo_no_id'])->get()->first();
            if ($show_jo_no_id['status']==9) {
                $change_status_JO['status']=4;
                JobOrder::find($check_jo_no['jo_no_id'])->update($change_status_JO);
            }
            $action2 = 'store';
            $message2 = 'Worker Successfully Saved';
            // dd($action2);
            $this->emit('flashActionModal2',$action2,$message2);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshAddWorkersTable');
        $this->emit('refreshAddWorkTable');
        $this->emit('closeWorkerForm');
    }
}
