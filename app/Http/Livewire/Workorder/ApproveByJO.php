<?php

namespace App\Http\Livewire\Workorder;

use App\Models\JobOrder;
use Livewire\Component;

class ApproveByJO extends Component
{
    protected $listeners = [
        'refreshParent' => '$refresh',
        'jobOrderNo',
    ];

    public function jobOrderNo(){
    }
    public function startALLworkOrders($id){
        $jo = JobOrder::find($id);
        foreach($jo->WorkOrders->where('status', 6) as $data){
            // $data->update(array('status', 9));
            $data->status = 5;
            $data->save();
        }

        $action = 'store';
        $message = 'Work Orders Successfully Started';
        $this->emit('flashActionModal1', $action, $message);
        $this->emit('refreshParent');
    }
    public function finishALLworkOrders($id){
        $jo = JobOrder::find($id);
        foreach($jo->WorkOrders->where('status', 8) as $data){
            // $data->update(array('status', 9));
            $data->status = 9;
            $data->save();
        }
        $action = 'store';
        $message = 'Work Orders Successfully Finished!';
        $this->emit('flashActionModal1', $action, $message);
        $this->emit('refreshParent');
    }
    public function render()
    {
        $jos = JobOrder::where('status', 1)->get();
        return view('livewire.workorder.approve-by-j-o',[
            'jos'=>$jos,
        ]);
    }

}
