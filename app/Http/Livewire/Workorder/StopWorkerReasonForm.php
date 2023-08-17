<?php

namespace App\Http\Livewire\Workorder;

use App\Models\AddWorker;
use App\Models\WorkOrder;
use Livewire\Component;

class StopWorkerReasonForm extends Component
{
    public $reason_stop='',$worker_Id,$work_order_id;
    protected $listeners= [
        'refreshworkerformend' => '$refresh',
        'worker_Id',
        'resetInput1',
        'work_order_id'
    ];
    
    public function work_order_id($work_order_id){
        $this->work_order_id=$work_order_id;
    }
    
    public function resetInput1(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function worker_Id($id)
    {
        $this->worker_Id=$id;
    }
    
    public function render()
    {
        return view('livewire.workorder.stop-worker-reason-form');
    }
    
    public function closeStopWorkerForm()
    {
        $this->resetInput1();
    }
    
    public function Stop_worker()
    {
        $this->worker_Id;
        $data=[
            'reason_stop' => $this->reason_stop,
        ];
        AddWorker::find($this->worker_Id)->update($data);
        $stop_start=[
        'start'     => null,
        'status'    => 6,
        ];
        
        
        AddWorker::find($this->worker_Id)->update($stop_start);
        $check_null_date = Addworker::all()->where('work_order_id',$this->work_order_id);
        $count_null_date=0;
        foreach($check_null_date as $null_date){
        if($null_date['start']==null){
        }
        else{
            $count_null_date++;
        }
        }
        
        if ($count_null_date>0) {
            $workorders = Addworker::where('work_order_id', $this->work_order_id)->get()
                                ->min('start')
                                ->toArray();
        
            $workorders1 = Addworker::where('work_order_id', $this->work_order_id)->where('start', $workorders['formatted'])->get()->first();
            $data_save=[
                'work_order_start_id'     =>$workorders1['id'],
                ];
        }else{
            $data_save=[
                'work_order_start_id'       =>null,
                'status'                    =>6,
                ];
        }
        
        $check_status_cancel = WorkOrder::where('id',$this->work_order_id)->first();
        if($check_status_cancel['status']==3){
        $data_save['status']=3;
        }
        WorkOrder::find($this->work_order_id)->update($data_save);
        
        
        $action2 = 'delete';
        $message2 = 'DateTime Successfully Stop';
        // dd($action2);
        $this->emit('flashActionModal2',$action2,$message2);
        
        $this->resetInput1();
        $this->emit('refreshAddWorkersTable');
        $this->emit('ClosestopWorkerModal');
        
    }
}
