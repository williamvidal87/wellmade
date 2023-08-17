<?php

namespace App\Http\Livewire\JOMS;

use Livewire\Component;
use App\Models\JobOrder;
use App\Models\Status;
use Livewire\WithPagination;
use App\Models\WorkOrder;

class JobOrderTable extends Component
{
    use WithPagination;
    public $joborderID;
    private $jobtypecompare;
    public $work_orders_of_jo = [], $work_types_jos = [], $all_work_types = [];
    public $status_filter, $compare_status=null;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'approvedJob',
        'canceledJO'
    ];

    public function create()
    {
        $this->emit('resetInputFields');
        $this->emit('openJobOrderFormModal');
        $this->emit('select2');
        $this->emit('refreshParentContact');
    }

    public function edit($joborderID)
    {
        $this->joborderID = $joborderID;
        $this->emit('joborderID', $this->joborderID);
        $this->emit('openJobOrderFormModal');
    }

    public function viewDetails($id){

        $this->emit('viewDetailsJO', $id);
        $this->emit('openviewDetailsModal');
    }

    public function AddMF($joborderID){

        $this->emit('openAddWorkOderTable',$joborderID);
        // $this->emit('openAddWorkOderTable');
        $this->joborderID = $joborderID;// william edited
        $this->emit('joborderID', $this->joborderID); // william edited
        $this->emit('jo_no_id',$joborderID);// william 
        $this->emit('compare_status', $this->compare_status); // william edited
    }

    public function AddSubType(){

        $this->emit('resetInputFields');
        $this->emit('openWorkSubTypeModal');
    }

    public function cancelJobOrder($id){
        $this->dispatchBrowserEvent('swal:confirmJobOrderCancel', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Cancel Job Order',
            'id' => $id
        ]);
    }

    public function viewClientContact($customer_id)
    {
        $this->emit('resetInputFields');
        $this->clientContactId = $customer_id;
        $this->emit('clientContactId', $this->clientContactId);
        $this->emit('jobOrderclientContactId', $this->clientContactId);
        $this->emit('openClientContactModal');
    }

    public function changeshowtablestatus()
    {
        $this->compare_status = $this->status_filter;
        $this->emit('refreshParent');
    }

    public function mount()
    {
        $this->emit('opentableaddworkoderrefresh');
    }

    public function canceledJO($id){

        $jo = JobOrder::where('id', $id)->first();
        $jo->update(array('status'=>3));
    }


    public function render()
    {
        if(is_null($this->compare_status)){

            $job_Orders = JobOrder::all();
        }else{

            $job_Orders = JobOrder::where('status', $this->compare_status)->get();
        }
        
        $work_orders = WorkOrder::all();

        return view('livewire.j-o-m-s.job-order-table', [
            'job_orders'=> $job_Orders,
            'wv'=>$work_orders,
            'status_filter_id'=> Status::whereIn('id',[1,2,3,4,9])->get(),
        ]);
    }

}