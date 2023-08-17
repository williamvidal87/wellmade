<?php

namespace App\Http\Livewire\JOMS;
use App\Models\JobOrder;

use Livewire\Component;

class JobOrderLogs extends Component
{
    public $data;

    protected $listeners = [
        'clicked_add_button',
        'record_updates',
        'created_records',
        'edit_record',
        'delete_record',
        'addWorkGroupLogs'
    ];

    public function render()
    {
        return view('livewire.j-o-m-s.job-order-logs');
    }

    public function clicked_add_button(){

    }
    public function record_updates(){

    }
    public function created_records($data){
        // dd($data);
        $this->data = $data;
        if($this->data->job_type_id == 1){

        }elseif($this->data->job_type_id == 2){

        }else{

        }
    }
    public function edit_record(){

    }
    public function delete_record(){

    }
    public function addWorkGroupLogs($data){

        if($data == 1){

        }elseif($data == 2){

        }else{

        }
    }
}
