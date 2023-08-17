<?php

namespace App\Http\Livewire\Workorder;

use App\Models\ClientProfile;
use App\Models\CalibWorkGroup;
use Livewire\Component;
use App\Models\Machines;
use App\Models\WorkOrder;
use App\Models\Status;
use App\Models\SubGroup;
use App\Models\SubGroupRates;
use App\Models\GeneralProcedure;
use App\Models\Discount;
use App\Models\DiscountPercentage;
use App\Models\IncentiveType;
use App\Models\job_types;
use App\Models\JobOrder;
use App\Models\ScopeDescription;
use App\Models\StockManagement;
use App\Models\WorkLoadUsedTools;
use App\Service\StockManagementService;
use phpDocumentor\Reflection\Types\Nullable;

class CalibrationWorkOrderForm extends Component
{
    public  $display_max_discount=0,
            $job_type_id,
            $jo_no_id,
            $reference_no_id,
            $calib_work_group_id,
            $calib_work_sub_type_id,
            $general_procedure_id,
            $scope_description_id,
            $machine_id,
            $remarks,
            $parts_required_id,
            $hours=0,
            $qty=0,
            $price=0,
            $amount_increase=0,
            $discount_id,
            $max_discount,
            $incentive_type_id=3,
            $incentive,
            $total;   
        public $Id;           //edit
        public $action = '';  //flash
        public $message = '';  //flash
        public $orderProducts = [];
        public $item_names = [];
        public $quantity = [];
        public $count = 0;
        public $bagerror = [0];
        private $stockManagementService;

    
    protected $listeners = [
        'Id',
        'resetInputFields',
        'jo_no_id'
    ];
    
    public function change()
    {
        
        $incentive_type_id_temp=1;
        $incentive_id_data1 = IncentiveType::whereid($incentive_type_id_temp)->get();
        foreach( $incentive_id_data1 as $key => $value1){
        }
        if($this->max_discount==$value1->incentive_type){
            $this->incentive_type_id=2;
        }
        if($this->max_discount>$value1->incentive_type){
            $this->incentive_type_id=1;
        }
        $incentive_id_data = IncentiveType::whereid($this->incentive_type_id)->get();
        foreach( $incentive_id_data as $key => $value){
        }
        if (!empty($this->qty)&&!empty($this->price)&&$this->max_discount>=0&&$this->max_discount!=null) {
            if ($this->amount_increase!=0) {
                $total_all=($this->qty*($this->price+$this->amount_increase));
            } else {
                $total_all=($this->qty*$this->price);
            }
            $total_convert=$value->incentive_type;
            $devided_total=$value->incentive_type/100;
            $total_all1=$total_all/1.12;
            $final = $this->max_discount/100;
            $total_max =(float)$final;
            $total_all2=$total_all1*$total_max;
            $total_all3=$total_all1-$total_all2;
            $total_all4=$total_all3*$devided_total;
            $this->incentive = round($total_all4, 2);
        }
    }
    
    public function jo_no_id($jo_no_id)
    {
    // dd($jo_no_id);
        $this->jo_no_id = $jo_no_id;
        $data = JobOrder::Where('id',$jo_no_id)->first();
        $this->reference_no_id = $data->reference_no;
        $find_costumer_numer = ClientProfile::Where('id',$data->customer_id)->first();
        $MAX_DISCOUNT_MF = DiscountPercentage::Where('id',$find_costumer_numer['discount_calib'])->first();
        $int = intval($MAX_DISCOUNT_MF['percentage']);
        $this->display_max_discount = $int;
    }

    public function addProduct()
    {
        $this->orderProducts[] = ['id_tools'=>'','work_order_id' => '','item_names' => '', 'quantity' => ''];
        $this->bagerror[] = [0];
    }

    public function removeProduct($index,StockManagementService $stockManagementService)
    {
        $this->stockManagementService = $stockManagementService;
        if(!empty($this->orderProducts[$index]['id_tools'])){
            // dd($this->orderProducts[$index]);
            $find_update = WorkLoadUsedTools::find($this->orderProducts[$index]['id_tools']);
            // dd($find_update->item_names);
            $this->stockManagementService->addItem($find_update->item_names, $find_update->quantity);
        }
        WorkLoadUsedTools::destroy($this->orderProducts[$index]);
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
        unset($this->bagerror[$index]);
        $this->bagerror = array_values($this->bagerror);
    }
    
    public function closemodal()
    {
    for ($i=count($this->orderProducts); $i >=0 ; $i--) {
        unset($this->orderProducts[$i]);
        unset($this->bagerror[$i]);
        $this->orderProducts = array_values($this->orderProducts);
    }
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function Id($id){    
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            unset($this->bagerror[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->Id = $id;
        $workOrder = WorkOrder::find($id);
        $this->job_type_id              = $workOrder->job_type_id;
        $this->jo_no_id                 = $workOrder->jo_no_id;
        $this->reference_no_id          = $workOrder->reference_no_id;
        $this->calib_work_group_id      = $workOrder->calib_work_group_id;
        $this->calib_work_sub_type_id   = $workOrder->calib_work_sub_type_id;
        $this->general_procedure_id     = $workOrder->general_procedure_id;
        $this->scope_description_id     = $workOrder->scope_description_id;
        $this->machine_id               = $workOrder->machine_id;
        $this->remarks                  = $workOrder->remarks;
        $this->parts_required_id        = $workOrder->parts_required_id;
        $this->hours                    = $workOrder->hours;
        $this->qty                      = $workOrder->qty;
        $this->price                    = $workOrder->price;
        $this->amount_increase          = $workOrder->amount_increase;
        $this->discount_id              = $workOrder->discount_id;
        $this->max_discount             = $workOrder->max_discount;
        $this->incentive_type_id        = $workOrder->incentive_type_id;
        $this->incentive                = $workOrder->incentive;
        $tools = WorkLoadUsedTools::all()->where('work_order_id', $this->Id);
        foreach ($tools as $tool){
            $this->orderProducts[$this->count] = ['id_tools'=>$tool->id,'work_order_id' => $tool->work_order_id,'item_names' => $tool->item_names, 'quantity' => $tool->quantity];
            $this->bagerror[$this->count] = [0];
            $this->count++;
        }

    }


    public function render()
    {
        $machines = Machines::select('id','machine_description_id','machine_group_id','machine_sub_group_id','machine_brand_id','capacity','machine_unit_id','arrival_date')->where('machine_dept_location_id',3)->with('getGroups','getAssignSubGroup','getMachineDescriptionName','getmachineunit','getmachinebrand')->get();
        return view('livewire.workorder.calibration-work-order-form',[
            'calibworkgroup' => SubGroup::whereIn('job_type_id',[3])->get(),
            'worksubtype'    => SubGroupRates::where('group_id',null)->get(),
            'scopedescriptions' => ScopeDescription::all(),
            'generalprocedure' => GeneralProcedure::all(),
            'workgroups' => SubGroup::all(),
            'processgroup' => SubGroup::all(),
            'processsubgroup' => SubGroupRates::all(),
            'statuses' => Status::whereIn('id',[10,11])->get(),
            'discount' => Discount::all(),
            'incentive_types' => IncentiveType::all(),
            'select_items' => StockManagement::all(),
            'id_count' => WorkOrder::all(),
            'exist_scope_description_id' => WorkOrder::all()
         ])->with('machines',$machines);
    }

    public function store(StockManagementService $stockManagementService){
    // dd($this->bagerror);
    for ($i=0; $i < count($this->bagerror); $i++) {
        $this->bagerror[$i]=0;
    }
    $countadd = 0;
        foreach ($this->orderProducts as $key => $value) {
            // dd($value['id_tools']);
            $find_total = StockManagement::find($value['item_names']);
            $this->bagerror[$countadd]=0;
            if($find_total['qty']<$value['quantity']){
            
                $this->bagerror[$countadd]=1;
                // dd($this->bagerror);
                // return back();
            }
            $countadd++;
            }
            for ($i=0; $i < count($this->bagerror); $i++) {
                if($this->bagerror[$i]==1){
                    return back();
                }
            }
            // dd($this->orderProducts);
    
        $action = '';

        $data = $this->validate([
            'job_type_id'           => '',
            'jo_no_id'              => '',
            'reference_no_id'       => '',
            'calib_work_group_id'   => 'required',
            'calib_work_sub_type_id'=> 'required',
            'general_procedure_id'  => '',
            'scope_description_id'  => 'required',
            'machine_id'            => '',
            'remarks'               => '',
            'parts_required_id'     => '',
            'hours'                 => '',
            'qty'                   => '',
            'price'                 => 'numeric',
            'amount_increase'       => 'numeric',
            'discount_id'           => 'numeric',
            'max_discount'          => 'numeric',
            'incentive_type_id'     => '',
            'incentive'             => '',
            'total'                 => ''
        ]);
        if ($this->max_discount==0) {
            $this->max_discount=1;
            $output=0;
        }
        else{
            $output = (($this->price+$this->amount_increase) * $this->qty)*($this->max_discount/100);
        }
        $total=(($this->price+$this->amount_increase) * $this->qty)-$output;
        $data['total']  =   $total;
        $data['job_type_id'] = 3; //changes
        try
		{   
        $this->stockManagementService = $stockManagementService;
		
		    // if($data['calib_work_sub_type_id']==26){
		        
            //     $data['general_procedure_id']=1;
		    // }
		    // if($data['calib_work_sub_type_id']==27){
		        
            //     $data['general_procedure_id']=2;
		    // }
            if($this->Id){
            
                WorkOrder::find($this->Id)->update($data);
                $upadatedId = $this->Id;
                
                // dd($this->orderProducts);
                for ($i=0; $i < count($this->orderProducts); $i++) {
                    $item_price_name = StockManagement::where('id',$this->orderProducts[$i]['item_names'])->get();
                    foreach($item_price_name as $key => $item_price)
                    $this->orderProducts[$i]['total']=$item_price['unit_price']*$this->orderProducts[$i]['quantity'];
                    if ($this->orderProducts[$i]['id_tools']=='') {
                        $this->orderProducts[$i]['work_order_id']=$upadatedId;
                        $this->stockManagementService->deductItem($this->orderProducts[$i]['item_names'], $this->orderProducts[$i]['quantity']);
                        WorkLoadUsedTools::create($this->orderProducts[$i]);
                    }else{
                        $findupdate = WorkLoadUsedTools::find($this->orderProducts[$i]['id_tools']);
                        $this->stockManagementService->addItem($findupdate->item_names, $findupdate->quantity);
                        WorkLoadUsedTools::find($this->orderProducts[$i]['id_tools'])->update($this->orderProducts[$i]);
                        $this->stockManagementService->deductItem($this->orderProducts[$i]['item_names'], $this->orderProducts[$i]['quantity']);
                    }
                }
            }else{
                $data['status'] = 6;
                $user = WorkOrder::create($data);
                $insertedId = $user->id;
                for ($i=0; $i < count($this->orderProducts); $i++) {
                    $this->orderProducts[$i]['work_order_id']=$insertedId;
                    
                    $this->stockManagementService->deductItem($this->orderProducts[$i]['item_names'], $this->orderProducts[$i]['quantity']);
                    
                    $item_price_name = StockManagement::where('id',$this->orderProducts[$i]['item_names'])->get();
                    foreach($item_price_name as $key => $item_price)
                    $this->orderProducts[$i]['total']=$item_price['unit_price']*$this->orderProducts[$i]['quantity'];
                    WorkLoadUsedTools::create($this->orderProducts[$i]);
                }
                
            }
		} catch (\Exception $e) {
			  dd($e);
			return back();
            $action = 'error';
            $this->emit('flashActionModal1',$action,$data);
            
		}

        if($this->Id){
            $action = 'edit';
            $message = 'Record Successfully Updated';
            // dd($this->$action);
            $this->emit('flashActionModal1',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Record Successfully Saved';
            // dd($this->$action);
            $this->emit('flashActionModal1',$action,$message);
            
        }
        $this->resetInputFields();
        $this->emit('refreshAddWorkTable');
        $this->emit('closeCalibModal');

    }
   
}