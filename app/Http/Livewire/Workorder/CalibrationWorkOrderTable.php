<?php

namespace App\Http\Livewire\Workorder;

use Livewire\Component;
use App\Models\CalibrationWorkOrder;
use App\Models\JobOrder;
use Livewire\WithPagination;

class CalibrationWorkOrderTable extends Component
{
    use WithPagination;

    public $Id;
  

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
       
    ];

    public function render()
    {
        return view('livewire.workorder.calibration-work-order-table',[
            'workOrder' => CalibrationWorkOrder::all()
            // 'workOrder' => JobOrder::where('job_type_id',3)->get()
            
        ]);
    }

    public function create(){
        $this->emit('resetInputFields');
        $this->emit('openModal');
    }

    public function edit($id){
        // dd($this->Id);
        $this->Id = $id;
        $this->emit('Id',$this->Id);
        $this->emit('openModal');
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

    public function delete($id){
        $action = 'delete';
        $message = ' ';
        // dd($action);
        $this->emit('flashAction',$action,$message);
    
        // dd($clientTypeId);
        CalibrationWorkOrder::destroy($id);
        $this->reset();
    }
}