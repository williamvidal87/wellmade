<?php

namespace App\Http\Livewire\Workorder;

use App\Models\AddWorker;
use App\Models\ClientProfile;
use App\Models\JobOrder;
use App\Models\JobTypes;
use App\Models\RequestPart;
use App\Models\RequestTool;
use App\Models\WorkOrder;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AddWorkOrderTable extends Component
{
    
    public  $action = '';  //flash
    public  $message = '';  //flash
    public $jo_no_id,$JOBNO,$CUSTOMER,$compare_status_id=0,$total_add=0;
    public $joID, $disable_print = null, $select_deselect = true;
    public $radiob, $work_orders_selected = array();

    protected $listeners = [
        'refreshAddWorkTable' => '$refresh',
        'jo_no_id',
        'delete',
        'compare_status',
        'PrintWorkOdersMethod',
        'turnToDeselect',
    ];

    public function turnToDeselect($val){
        $this->select_deselect = $val;
    }

    public function selectAllMethod(){

        $this->disable_print = null;
        $this->select_deselect = false;
        $work_orders = WorkOrder::where('jo_no_id', $this->jo_no_id)->get();
        $work_order_ids = array();
        foreach($work_orders as $id){
            if($id->status !== 3){
                if(count($id->workers) !== 0){
                    array_push($work_order_ids, $id->id);
                }
            }
            // if(count($id->workers) !== 0){ array_push($work_order_ids, $id->id);
        }

        $this->emit('selectAllWorkOrders', $work_order_ids);
    }

    public function deselect(){

        $this->disable_print = null;
        $this->select_deselect = true;
        $this->emit('deselectAllWorkOrders');
    }

    public function PrintWorkOdersMethod($val){
        
        if(is_array($val)){
            $id = $this->jo_no_id;
            $work_orders = WorkOrder::whereIn('id',$val)->get();
            $jo = JobOrder::where('id', $id)->first();
            if(!empty(json_decode($work_orders))){
                // $user_id = strval(auth()->user()->id);
                $work_date_start = Carbon::now()->toDateString();
                $CURRENT_TIME = Carbon::now('Asia/Manila');
                $current_date_printed = Carbon::now()->isoFormat('MMMM D, Y');
    
                if(is_null($jo->engine_model)){
                    
                    $engine_model = null;
                    $makelist = null;
    
                }
                else{
    
                    $engine_model = $jo->engineModel->model;
                    $makelist = $jo->getMakeList->make_name;
    
                }
    
                $encoder_role = Role::whereId(8)->first();
                $encoder = User::role($encoder_role->name)->first();
    
                $data = [
                    'records'=>$work_orders,
                    'jo_no'=>$jo->jo_no,
                    // 'operator'=> $operators,
                    // 'start_date'=>!is_null($jo_data->work_date_start) ? $jo_data->work_date_start->isoFormat('MMMM D Y') : null,
                    'scannedID'=> strval($id),
                    'makelist'=>$makelist,
                    'jo_model'=>$engine_model,
                    'jo_serial'=>$jo->serial_no,
                    'encoder'=>$jo->getEncoder->name ?? "None",
                    'work_date_start'=>$work_date_start,
                    'current_date_printed'=>$current_date_printed,
                    'CURRENT_TIME'=>$CURRENT_TIME->format('g:i A'),
                    'encoder'=>auth()->user()->name,
                    'type_of_print'=>'PA',
                ];
        
                $pdfContent = PDF::loadView('livewire.print-work-order.print-all-work-orders', ['viewdata'=>$data])->output();
                return response()->streamDownload(
                fn () => print($pdfContent),
                "all-work-orders.pdf"
                );
            }
        }else{

            $this->disable_print = 'error';
        }
    }
    

    public function render()
    {
        $job_types = array('MF'=>0,'ER'=>0,'Calib'=>0);
        $total_amount = 0;
        $work_orders_count = WorkOrder::where('jo_no_id', $this->jo_no_id)->get();
        foreach($work_orders_count as $data){
            if($data->mf_work_group_id){
                $job_types['MF']++;
            }elseif($data->er_work_group_id){
                $job_types['ER']++;
            }else{
                $job_types['Calib']++;
            }
            $total_amount = $total_amount + ($data->price * $data->qty);

        }

        $user_role = auth()->user()->roles;

        $jobTypes = ['MF','ER','Calib'];
        // $request_part = RequestPart::with('getRequestTool.requestToolsData.getStockManagment')
        //     ->whereNotNull('request_tools_id')
        //     ->whereNotNull('jo_no_id')
        //     ->whereHas('getRequestTool', function ($query) {
        //         $query->where('status_id', 2);
        //     })
        //     ->where('jo_no_id', $this->jo_no_id)
        //     ->get();
        $request_part = RequestTool::with('requestToolsData.getStockManagment')
            ->where('jo_no_id', $this->jo_no_id)
            ->where('status_id', 2)
            ->get();
        $work = WorkOrder::where('jo_no_id',$this->jo_no_id)->with('getJobType','getMFWorkGroup','getERWorkGroup','getCalibWorkGroup','getStatusWorkOrder')->get();
        return view('livewire.workorder.add-work-order-table',[
            'name' => ClientProfile::all(),
            'jobtype' => JobTypes::all(),
            'work_orders_count'=>$work_orders_count,
            'types'=>$jobTypes,
            'total'=>$total_amount,
            'job_types'=>$job_types,
            'user_login'=>auth()->user()->name,
            'user_role'=>$user_role,
            'request_parts' => $request_part,
        ])
        ->with('work',$work);
    }
    
    public function jo_no_id($jo_no_id)
   {
        $this->jo_no_id=$jo_no_id;
        $jo = JobOrder::where('id', $jo_no_id)->first();
        // $NO = JobOrder::where('id',$this->jo_no_id)->first()->with('getJobOrder')->get();
        // foreach($NO as $ref_no)
        $this->JOBNO = $jo->reference_no;
        $this->CUSTOMER = $jo->getJobOrder->name;
   }

   
   public function compare_status($compare_status){
    $this->compare_status_id=$compare_status;
   }
    
    public function openModalMF(){

        $this->jobTypeID = $this->jo_no_id;// william edited
        $this->joborderID = $this->jo_no_id;// william edited
        $this->emit('joborderID', $this->jo_no_id); // william edited
        $this->emit('resetInputFields');// william edited
        $this->emit('jo_no_id',$this->jo_no_id);// william edited
        $this->emit('openMFModal');
    }
    public function openModalEr()
    {
        $this->jobTypeID = $this->jo_no_id;// william edited
        $this->joborderID = $this->jo_no_id;// william edited
        $this->emit('joborderID', $this->jo_no_id); // william edited
        $this->emit('resetInputFields');// william edited
        $this->emit('jo_no_id',$this->jo_no_id);// william edited
        $this->emit('openERModal');
    }
    public function openModalCalib()
    {
        $this->jobTypeID = $this->jo_no_id;// william edited
        $this->joborderID = $this->jo_no_id;// william edited
        $this->emit('joborderID', $this->jo_no_id); // william edited
        $this->emit('resetInputFields');// william edited
        $this->emit('jo_no_id',$this->jo_no_id);// william edited
        $this->emit('openCalibModal');
    }
    
    public function AddWorker($id)
    {
        $this->emit('openAddWorkerTable');
        $this->emit('work_order_id',$id);
    }
    
    public function edit($id){
        $jo_no = WorkOrder::all()->where('id', $id);
        foreach($jo_no as $jono){
        }
        $job_type_ref=$jono->job_type_id;
        if($job_type_ref==1){
            $this->Id = $id;
            $this->emit('Id',$this->Id);
            $this->emit('jo_no_id',$this->jo_no_id);// william edited
            $this->emit('openMFModal');
                // dd($joborderID);

        }elseif($job_type_ref==2){
            // dd("value");
            $this->Id = $id;
            $this->emit('Id',$this->Id);
            $this->emit('jo_no_id',$this->jo_no_id);// william edited
            $this->emit('openERModal');

        }
        else{
            
            $this->Id = $id;
            $this->emit('Id',$this->Id);
            $this->emit('jo_no_id',$this->jo_no_id);// william edited
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
    
    public function cancelWorkOrder($id)
    {
        $this->emit('cancelWorkOrderModal');
        $this->emit('work_order_id',$id);
    }

    public function PrintingWorkOrders(){

        $this->emit('print_work_orders_script');
    }
    
    public function delete($id){   
        $action = 'delete';
            $message = 'Record Successfully Deleted';
            // dd($action);
            $this->emit('flashActionModal1',$action,$message);
            
        WorkOrder::destroy($id);
        $this->emit('refreshAddWorkTable');
    }
    
    public function PrintAllWorkOrders($id){
        $this->emit('wastedID');
        $this->emit('postAdded');
    }

    public function editPrice($requestToolsId, $joNoId)
    {
        $this->emit('priceModal');
        $this->emit('setAttribPrice', $requestToolsId, $joNoId);
    }

    public function PrintWorkTypes($id){

        $work_date_start = Carbon::now()->toDateString();
        $CURRENT_TIME = Carbon::now('Asia/Manila');
        $current_date_printed = Carbon::now()->isoFormat('MMMM D, Y');
        $work_order_ids = array();
        if($id == 0){
            $mf = ++$id;
            $work_orders = WorkOrder::where('job_type_id', $mf)
                                ->where('jo_no_id', $this->jo_no_id)
                                ->get();
            $jo = JobOrder::where('id', $this->jo_no_id)->first();
        }elseif($id == 1){
            $er = 2;
            $work_orders = WorkOrder::where('job_type_id', $er)
                                ->where('jo_no_id', $this->jo_no_id)
                                ->get();
            $jo = JobOrder::where('id', $this->jo_no_id)->first();
        }

        if(count($work_orders) !== 0){

            foreach($work_orders as $id){

                if(count($id->workers) !== 0){ array_push($work_order_ids, $id->id); }
            }

            $this->emit('checkedByWorkOrderType',$work_order_ids);

            $index = 0;
            $page_no = 1;
    
            foreach($work_orders as $wv){
    
                $index = $index + count($wv->workers);
            }
    
            foreach($work_orders as $workorder){
    
                foreach($workorder->workers as $value){
    
                    $value->page_no = $page_no . " of " . $index;
                    $value->save();
                    ++$page_no;
    
    
                }
    
            }
    
    
            $encoder_role = Role::whereId(8)->first();
            // $admin = Role::whereId(2)->first();
            // dd(auth()->user()->role);
            $encoder = User::role($encoder_role->name)->first();
            
            $data = [
                'records'=>$work_orders,
                'jo_no'=>$jo->jo_no,
                'scannedID'=> strval($id),
                'makelist'=>$jo->getMakeList->make_name ?? "",
                'jo_model'=>$jo->engineModel->model ?? "",
                'jo_serial'=>$jo->serial_no,
                'encoder'=>$jo->getEncoder->name ?? $encoder->name,
                'work_date_start'=>$work_date_start,
                'current_date_printed'=>$current_date_printed,
                'CURRENT_TIME'=>$CURRENT_TIME->format('g:i A'),
                'type_of_print'=>'BWT',
            ];
    
            $pdfContent = PDF::loadView('livewire.print-work-order.print-all-work-orders', ['viewdata'=>$data])->output();
            return response()->streamDownload(
            fn () => print($pdfContent),
            "work-orders.pdf"
            );

        }
    }
}