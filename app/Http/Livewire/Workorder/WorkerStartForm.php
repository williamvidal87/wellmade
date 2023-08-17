<?php

namespace App\Http\Livewire\Workorder;

use App\Models\AddWorker;
use App\Models\WorkOrder;
use Livewire\Component;

class WorkerStartForm extends Component
{
    public $start,$start_date_worker,$start_hour_worker="00",$start_minute_worker="00",$reason_start,$worker_Id,$work_order_id;
    public $action2 = '';  //flash
    public $message2 = '';  //flash
    protected $listeners= [
        'refreshworkerformstart' => '$refresh',
        'worker_Id',
        'work_order_id',
        'resetInputFields',
    ];
    
    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function render()
    {
        return view('livewire.workorder.worker-start-form');
    }
    
    public function closeAddFormStartWorker()
    {
        $this->emit('closeWorkerStartForm');
        $this->resetInputFields();
        $this->emit('refreshworkerformstart');
    }
    
    public function work_order_id($work_order_id){
        $this->work_order_id=$work_order_id;
    }
    
    public function worker_Id($worker_Id)
    {
        $this->worker_Id=$worker_Id;
        $addworker = AddWorker::find($this->worker_Id);
        $addworker->start;
        if(empty($addworker->start)){
        $this->start_date_worker='0000-00-00';
        $this->start_hour_worker='00';
        $this->start_minute_worker='00';
        $this->reason_start='';
        }else{
            $this->start_date_worker=date('Y-m-d', strtotime($addworker->start));
            $this->start_hour_worker=date('H', strtotime($addworker->start));
            $this->start_minute_worker=date('i', strtotime($addworker->start));
            $this->reason_start=$addworker->reason_start;
        }
    }
    
    public function store()
    {
        // dd($this->start_date_worker." ".$this->start_hour_worker.":".$this->start_minute_worker.":00".$this->reason_start);
        $data = [
            'start'         => $this->start_date_worker." ".$this->start_hour_worker.":".$this->start_minute_worker.":00",
            'reason_start'  => $this->reason_start,
            'status'        => 5,
        ];
        $check_end_time=AddWorker::Where('id',$this->worker_Id)->get()->first();
        if($this->start_date_worker." ".$this->start_hour_worker.":".$this->start_minute_worker.":00">=$check_end_time['end']&&$check_end_time['end']!=null){
            request()->validate([
                'start_date_worker' => 'required',
            ],
            [
                'start_date_worker.required' => 'date start should lessthan to date end',
            ]);
        }
        
        AddWorker::find($this->worker_Id)->update($data);
        $worker = AddWorker::where('id',$this->worker_Id)->first();
        $worker->status = 5;
        $worker->save();
        $worker->getWorkOrder->update(array('status'=>5));

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
            $message2 = 'Start DateTime Successfully Updated';
            // dd($action2);
            $this->emit('flashActionModal2',$action2,$message2);
        }
        else{
            $action2 = 'store';
            $message2 = 'Start DateTime Successfully Saved';
            // dd($action2);
            $this->emit('flashActionModal2',$action2,$message2);
            
        }
        $workorders = Addworker::where('work_order_id',$this->work_order_id)->get()
                                ->min('start')
                                ->toArray();
        $workorders1 = Addworker::where('work_order_id',$this->work_order_id)->where('start',$workorders['formatted'])->get()->first();
        $data_save=[
        'work_order_start_id'       =>$workorders1['id'],
        'status'                    =>5,
        ];
        
        $check_status_cancel = WorkOrder::where('id',$this->work_order_id)->first();
        if($check_status_cancel['status']==3){
        $data_save['status']=3;
        }
        
        WorkOrder::find($this->work_order_id)->update($data_save);
        
        $this->resetInputFields();
        $this->emit('refreshAddWorkersTable');
        $this->emit('closeWorkerStartForm');
    }
}
