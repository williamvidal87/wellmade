<?php

namespace App\Http\Livewire\Workorder;

use App\Models\AddWorker;
use App\Models\JobOrder;
use App\Models\WorkOrder;
use Livewire\Component;

class AddWorkerTable extends Component
{
    public $work_order_id,$worker_Id;
    
    protected $listeners = [
        'refreshAddWorkersTable' => '$refresh',
        'work_order_id',
        'deleteWorker',
    ];
    
    public function mount()
    {
        $this->emit('opendatatableworker');
    }
    
    public function render()
    {
        $worker_name = AddWorker::where('work_order_id',$this->work_order_id)->with('getWorker','getPercent','getPartsPercent')->get();
        return view('livewire.workorder.add-worker-table')->with('workers',$worker_name);
    }
    
    public function work_order_id($work_order_id){
        $this->work_order_id=$work_order_id;
    }
    
    public function createWorkers()
    {
        $this->emit('resetInputFields');
        $this->emit('work_order_id',$this->work_order_id);
        $this->emit('openWorkerForm');
    }
    
    public function AddStartWorker($worker_Id)
    {
        $this->emit('worker_Id',$worker_Id);
        $this->emit('work_order_id',$this->work_order_id);
        $this->emit('openWorkerStartForm');
    }
    
    public function AddEndWorker($worker_Id)
    {
        $this->emit('worker_Id',$worker_Id);
        $this->emit('work_order_id',$this->work_order_id);
        $this->emit('openWorkerEndForm');
    }
    
    public function edit($worker_Id)
    {
        $this->worker_Id=$worker_Id;
        $this->emit('worker_Id',$this->worker_Id);
        $this->emit('openWorkerForm');
    }
    public function deleteConfirmWorker($worker_Id){
        $this->dispatchBrowserEvent('swal:confirmDeleteWorker', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $worker_Id
        ]);
    }
    
    public function StopWorker($worker_Id){
        $this->worker_Id=$worker_Id;
        $this->emit('worker_Id',$this->worker_Id);
        $this->emit('work_order_id',$this->work_order_id);
        $this->emit('OpenstopWorkerModal');
        
    }
    
    public function deleteWorker($worker_Id)
    {
        $action2 = 'delete';
        $message2 = 'Record Successfully Deleted';
        // dd($action2);
        $this->emit('flashActionModal2',$action2,$message2);
        AddWorker::destroy($worker_Id);
        $check_null_date = Addworker::where('work_order_id',$this->work_order_id)->get()->first();
        if (!empty($check_null_date['start'])) {
            $workorders_min = Addworker::where('work_order_id', $this->work_order_id)->get()
                                ->min('start')
                                ->toArray();
            $workorders1_min = Addworker::where('work_order_id', $this->work_order_id)->where('start', $workorders_min['formatted'])->get()->first();
            $workorders_max = Addworker::where('work_order_id', $this->work_order_id)->get()
                                ->max('end')
                                ->toArray();
            $workorders1_max = Addworker::where('work_order_id', $this->work_order_id)->where('end', $workorders_max['formatted'])->get()->first();
            $data_save=[
        'work_order_start_id'       =>$workorders1_min['id'],
        'work_order_end_id'         =>$workorders1_max['id'],
        ];
        }
        else{
            $data_save=[
                'work_order_start_id'       =>null,
                'work_order_end_id'         =>null,
                'status'                    =>6,
                ];
        }
        $check_status_cancel = WorkOrder::where('id',$this->work_order_id)->first();
        if($check_status_cancel['status']==3){
        $data_save['status']=3;
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
        
        
        $this->emit('refreshAddWorkersTable');
        $this->emit('refreshAddWorkTable');
        $this->emit('closeModalWorkerDelete');
        $this->emit('resetInputFields');
    }
    
    
    
}
