<?php

namespace App\Http\Livewire\Workorder;

use App\Models\AddWorker;
use App\Models\ClientProfile;
use App\Models\JobOrder;
use App\Models\JobTypes;
use App\Models\WorkLoadUsedTools;
use Livewire\Component;
use App\Models\WorkOrder;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class MfWorkOrderTable extends Component
{
    use WithPagination;

    public $Id, $work_type;
  

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
       
    ];

    public function render()
    {  

        $work = WorkOrder::all()->sortBy('id');
        return view('livewire.workorder.mf-work-order-table',[
            'work'=>$work,
        ]);
    }

    public function create(){
        $this->emit('resetInputFields');
        $this->emit('openModal');
    }

    
    public function edit($id){
        $jo_no = WorkOrder::all()->where('id', $id);
        foreach($jo_no as $jono){

        }
        $jotype_ref = $jono['job_type_id'];
        if($jotype_ref==1){
            $this->Id = $id;
            $this->emit('Id',$this->Id);
            $this->emit('openMFModal');

        }elseif($jotype_ref==2){
            $this->Id = $id;
            $this->emit('Id',$this->Id);
            $this->emit('openERModal');

        }
        else{
            
            $this->Id = $id;
            $this->emit('Id',$this->Id);
            $this->emit('openCalibModal');

        }
    }

    public function deleteConfirm($id){
        
        $this->dispatchBrowserEvent('swal:confirmDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $id
        ]);
    }

    public function printJobOrder($dataID){
        $this->emit('printWorkOrder',$dataID);
        $this->emit('openPrintModal');
    }
    public function delete($id){
        $this->count=0;
        $tools = WorkLoadUsedTools::all()->where('work_order_id', $id);
        foreach ($tools as $tool){
        
            WorkLoadUsedTools::destroy($tool->id);
            $this->count++;
        }
        WorkOrder::destroy($id);
        $this->resetPage();
    }
}