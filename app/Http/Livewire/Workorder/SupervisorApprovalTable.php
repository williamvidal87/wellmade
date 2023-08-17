<?php

namespace App\Http\Livewire\Workorder;

use App\Models\AddWorker;
use App\Models\JobOrder;
use App\Models\WorkOrder;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SupervisorApprovalTable extends Component
{
    use WithPagination;
    public $operator_id;
    protected $listeners = [
        'refreshParent' => '$refresh',
        'authorizedWorkOrder',
        'releasedworkorder',
        'reworkconfirmWorkOrder'
    ];
    
    public function authorizedWorkOrder($id){

        $joborder = JobOrder::find($id);
        $joborder->update(array('status'=>4));
        $joborder->WorkOrders()->update(['status' => 5]);
        foreach($joborder->WorkOrders as $workorder){
            $workorder->workers()->update(['status' => 5]);
        }

        // $joborder->update(array('status'=>4));

        // foreach($joborder->WorkOrders as $data){

        //     $data->status = 5;
        //     $data->save();

        //     foreach($data->workers as $worker){

        //         $worker->status = 5;
        //         $worker->save();
        //     }
        // }

        $action = 'store';
        $message = 'Job Order No: ' . $joborder->jo_no . ' Work Orders Started!';
        $this->emit('flashActionModal1', $action, $message);
        $this->emit('refreshParent');
    }

    public function render()
    {
        $role = Role::whereIn('id', [8,9])->get();
        $jos = JobOrder::whereIn('status', [1])->get();
        $user = auth()->user()->roles;
        // dd($user[0]->name);
        // dd($worker=Role::whereIn('id', [6,9])->get());
        $work_order_approval = WorkOrder::where('status', 6)->get();
        $operators = AddWorker::all();

        return view('livewire.workorder.supervisor-approval-table', [
            'jobOrders'=>$jos,
            'user_name'=>auth()->user()->name,
            'approvals'=> $work_order_approval,
            'operators'=>$operators,
            'user'=>$user,
        ]);
    }

    public function startALLworkOrders($id){

        $this->dispatchBrowserEvent('swal:confirmAuthorizeWorkOrder', [
            'title' => 'Start All Work Order?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Confirm',
            'id' => $id
        ]);
    }

}
