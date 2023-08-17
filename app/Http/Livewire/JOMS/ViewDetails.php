<?php

namespace App\Http\Livewire\JOMS;

use App\Models\WorkOrder;
use Livewire\Component;

class ViewDetails extends Component
{
    public $joID;
    protected $listeners = [
        'viewDetailsJO'
    ];

    public function viewDetailsJO($id){
        $this->joID = $id;
    }

    public function render()
    {
        $job_types = array('MF'=>0,'ER'=>0,'Calib'=>0);
        $total_amount = 0;
        $work_orders = WorkOrder::where('jo_no_id', $this->joID)->get();
        foreach($work_orders as $data){
            if($data->mf_work_group_id){
                $job_types['MF']++;
            }elseif($data->er_work_group_id){
                $job_types['ER']++;
            }else{
                $job_types['Calib']++;
            }
            $total_amount = $total_amount + ($data->price * $data->qty);

        }

        $jobTypes = ['MF','ER','Calib'];
        return view('livewire.j-o-m-s.view-details', [
            'workorders'=>$work_orders,
            'types'=>$jobTypes,
            'total'=>$total_amount,
            'job_types'=>$job_types,
        ]);
    }
}
