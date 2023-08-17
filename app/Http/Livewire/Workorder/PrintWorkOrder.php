<?php

namespace App\Http\Livewire\Workorder;

use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\JobOrder;
use App\Models\WorkOrder;
use Carbon\Carbon;

class PrintWorkOrder extends Component
{
    public $dataID, $remarks, $serial_no,$data,$status, $scannedID;
    public $jo_data, $user_id, $discount, $work_type;

    protected $listeners = [
        'printWorkOrder'
    ];

    public function printWorkOrder($dataID){
        // dd("zudifgdsuif");
        $this->dataID = $dataID;
        $this->scannedID = $dataID;
    }

    public function updatedScannedID(){
        $this->user_id = auth()->user()->id;
        $this->data = WorkOrder::where('id', $this->dataID)->first();
        if($this->data){

            if($this->data->mf_work_group_id){
                $this->work_type = "MF";
            }else if($this->data->er_work_group_id){
                $this->work_type = "ER";
            }else if($this->data->calib_work_group_id){
                $this->work_type = "CALIB";
            }

            $this->jo_data = JobOrder::where('jo_no',$this->data->getJobOrder->jo_no)->first();
            $date_start =  Carbon::now()->toDateTimeString();//isoFormat('MMMM D Y');
            $this->status = 5;
            $work_date_start = $this->jo_data->work_date_start;
            WorkOrder::where('id', $this->scannedID)->update(array('status'=>$this->status));
            if(is_null($work_date_start)){
                JobOrder::where('jo_no', $this->data->getJobOrder->jo_no)->update(array('work_date_start' => $date_start));
            }
        }

    
    }

    public function export2PDF(){

        $data = [
            'reference_no'=>$this->data->reference_no_id,
            'generalprocedure'=>$this->data->getGeneralProcedure->general_procedure_name,
            'machineid'=>$this->data->getMachine->machine_name,
            'status'=>$this->jo_data->statusess->status,
            'max_discount'=>$this->data->max_discount,
            'suggested_cost'=>$this->data->suggested_cost,
            'process-cost'=>$this->data->process_cost,
            'hrs'=>$this->data->hours,
            'qty'=>$this->data->qty,
            'amount_increase'=>$this->data->amount_increase,
            'discount_id'=>$this->data->discount_id,
            'jo_no'=>$this->data->getJobOrder->jo_no,
            'process_group'=>$this->data->getProcessGroup->sub_group,
            'process_sub_group'=>$this->data->getProcessSubGroup->sub_group,
            'process_cost'=>$this->data->process_cost,
            'start_date'=>$this->jo_data->work_date_start->isoFormat('MMMM D Y'),
            'incentive'=> $this->data->incentive,
            'user_id'=>$this->user_id,
            // 'discount'=>$this->discount,
            'parts_required'=>$this->data->parts_required_id,
            'scannedID'=> $this->scannedID,
            'makelist'=>$this->jo_data->getMakeList->make_name,
            'jo_model'=>$this->jo_data->engineModel->model,
            'jo_serial'=>$this->jo_data->serial_no,
            'work_type'=>$this->work_type
            // 'datas'=> $this->data
        ];
        if($this->work_type == "MF"){
            $data['mfworkgroup']= $this->data->getMFWorkGroup->group_name;
            $data['mfworksubtype']= $this->data->getMFWorkSubType->sub_group;
            // dd($data);
        }else if($this->work_type == "ER"){
            $data['er_work_group']= $this->data->getERWorkGroup->group_name;
            $data['er_work_group_subtype']= $this->data->getERWorkSubType->scope_name;
            // dd($data);
        }else if($this->work_type == "CALIB"){
            $data['calib_work_group']= $this->data->getCalibWorkGroup->group_name;
            $data['calib_work_subtype']= $this->data->getCalibWorkSubType->sub_group;
            // dd($data);
        }

        $pdfContent = PDF::loadView('livewire.print-work-order.p-d-f-format-work-load', ['viewdata'=>$data])->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
        "record.pdf"
        );
    }

    public function render()
    {
        return view('livewire.workorder.print-work-order');
    }
}
