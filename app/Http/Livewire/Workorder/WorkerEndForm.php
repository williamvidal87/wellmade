<?php

namespace App\Http\Livewire\Workorder;

use App\Models\AddWorker;
use App\Models\JobOrder;
use App\Models\WorkOrder;
use Livewire\Component;

class WorkerEndForm extends Component
{
    public $end_date_worker,$end_hour_worker="00",$end_minute_worker="00",$reason_end,$worker_Id,$work_order_id;
    public $action2 = '';  //flash
    public $message2 = '';  //flash
    protected $listeners= [
        'refreshworkerformend' => '$refresh',
        'worker_Id',
        'work_order_id',
        'resetInputFields'
    ];
    
    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function render()
    {
        return view('livewire.workorder.worker-end-form');
    }
    
    public function closeAddFormEndWorker()
    {
        $this->emit('closeWorkerEndForm');
        $this->resetInputFields();
        $this->emit('refreshworkerformend');
    }
    
    public function work_order_id($work_order_id){
        $this->work_order_id=$work_order_id;
    }
    
    public function worker_Id($worker_Id)
    {
        $this->worker_Id=$worker_Id;
        $addworker = AddWorker::find($this->worker_Id);
        $addworker->end;
        if(empty($addworker->end)){
        $this->end_date_worker='0000-00-00';
        $this->end_hour_worker='00';
        $this->end_minute_worker='00';
        $this->reason_end='';
        }else{
            $this->end_date_worker=date('Y-m-d', strtotime($addworker->end));
            $this->end_hour_worker=date('H', strtotime($addworker->end));
            $this->end_minute_worker=date('i', strtotime($addworker->end));
            $this->reason_end=$addworker->reason_end;
        }
    }
    
    public function store()
    {
        // dd($this->end_date_worker." ".$this->end_hour_worker.":".$this->end_minute_worker.":00".$this->reason_end);
        $data = [
            'end'         => $this->end_date_worker." ".$this->end_hour_worker.":".$this->end_minute_worker.":00",
            'reason_end'  => $this->reason_end,
            'status'      => 9,
        ];
        $check_start_time=AddWorker::Where('id',$this->worker_Id)->get()->first();
        if ($this->end_date_worker." ".$this->end_hour_worker.":".$this->end_minute_worker.":00"<=$check_start_time['start']&&$check_start_time['start']!=null) {
            request()->validate(
                [
                'end_date_worker' => 'required',
            ],
                [
                'end_date_worker.required' => 'date end should greaterthan to date start',
            ]
            );
        }
        AddWorker::find($this->worker_Id)->update($data);
        
        try
		{
            if($this->worker_Id){
                AddWorker::find($this->worker_Id)->update($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action2 = 'error';
            $this->emit('flashActionModal2',$action2,$data);
		}

        if($this->worker_Id){
            $action2 = 'edit';
            $message2 = 'End DateTime Successfully Updated';
            // dd($action2);
            $this->emit('flashActionModal2',$action2,$message2);
        }
        else{
            $action2 = 'store';
            $message2 = 'End DateTime Successfully Saved';
            // dd($action2);
            $this->emit('flashActionModal2',$action2,$message2);
            
        }
        $workorders = Addworker::where('work_order_id',$this->work_order_id)->get()
                                ->max('end')
                                ->toArray();
        $workorders1 = Addworker::where('work_order_id',$this->work_order_id)->where('end',$workorders['formatted'])->get()->first();
        $data_save=[
        'work_order_end_id'     =>$workorders1['id'],
        ];
        $check_all_end_date_done = Addworker::where('work_order_id',$this->work_order_id)->get();
        $count_all_done_date=0;
        foreach($check_all_end_date_done as $all_end_date_done)
        {
            if(empty($all_end_date_done)){
            $count_all_done_date++;
            }
        }
        
        $check_status_cancel = WorkOrder::where('id',$this->work_order_id)->first();
        if($count_all_done_date>0){
            $data_save['status']=5;
        }
        if($check_status_cancel['status']==3){
            $data_save['status']=3;
        }else{
            $data_save['status']=9;
        }
        
        
        WorkOrder::find($this->work_order_id)->update($data_save);
        
        // Check Job Order done
        $show_JO_NO=WorkOrder::Where('id',$this->work_order_id)->get()->first();
        $check_WORKORDER_done=WorkOrder::Where('jo_no_id',$show_JO_NO['jo_no_id'])->get();
        $done=0;
        foreach($check_WORKORDER_done as $check_work_order_done){
            $check_work_order_done;
            if($check_work_order_done['status']!=9){
                $done++;
            }
        }
        if($done==0){
            $change_status_JO['status']=9;
            JobOrder::find($show_JO_NO['jo_no_id'])->update($change_status_JO);
        }
        
        $this->resetInputFields();
        $this->emit('refreshAddWorkersTable');
        $this->emit('closeWorkerEndForm');
    }
}