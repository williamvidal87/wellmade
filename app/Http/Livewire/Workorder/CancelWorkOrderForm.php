<?php

namespace App\Http\Livewire\Workorder;

use App\Models\DeleteReason;
use App\Models\WorkOrder;
use Livewire\Component;
use Throwable;

class CancelWorkOrderForm extends Component
{
    public $work_order_id,$cancel_reason_id;
    protected $listeners = [
        'work_order_id'
    ];
    
    public function work_order_id($id){
    $this->work_order_id=$id;
    }
    
    public function render()
    {
        return view('livewire.workorder.cancel-work-order-form',[
            'cancelreason' => DeleteReason::all(),
        ]);
    }
    
    public function saveCancelRemarks()
    {
        $data=[
            'cancel_reason_id'      => $this->cancel_reason_id,
            'status'                => 3,
            'user_cancel_id'        =>auth()->user()->id,    
        ];
        WorkOrder::find($this->work_order_id)->update($data);
        $this->emit('ClosecancelWorkOrderModal');
        $action = 'delete';
            $message = 'Record Successfully cancelled';
            // dd($action);
            $this->emit('flashActionModal1',$action,$message);
            $this->emit('refreshAddWorkTable');
            $this->reset();
            $this->resetValidation();
            $this->resetErrorBag();
    }
}
