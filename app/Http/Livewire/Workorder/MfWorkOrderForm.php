<?php

namespace App\Http\Livewire\Workorder;

use App\Models\ClientProfile;
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
use App\Models\ProcessGroup;
use App\Models\ProcessSubGroup;
use App\Models\StockManagement;
use App\Models\WorkLoadUsedTools;
use App\Models\WorkSubType;
use App\Service\StockManagementService;

class MfWorkOrderForm extends Component
{   
        public  $display_max_discount=0,
                $job_type_id,
                $jo_no_id,
                $reference_no_id,
                $mf_work_group_id,
                $mf_work_sub_type_id,
                $general_procedure,
                $scope_description = "",
                $process_group_id,
                $process_subgroup_id,
                $machine_id,
                $process_cost=0,
                $remarks,
                $parts_required_id,
                $hours=0,
                $qty=0,
                $price=0,
                $amount_increase=0,
                $discount_id,
                $max_discount,
                $incentive_type_id,
                $incentive,
                $total;           
        public  $Id;           //edit
        public  $action = '';  //flash
        public  $message = '';  //flash
        public  $orderProducts = [];
        public  $item_names = [];
        public  $quantity = [];
        public  $count = 0;
        public  $bagerror = [0];
        private $stockManagementService;
        public $reference_no;
        
    
    protected $listeners = [
        'Id',
        'resetInputFields',
        'jo_no_id'
    ];
    
    public function change()
{
    $incentive_id_data = IncentiveType::whereid($this->incentive_type_id)->get();
    foreach( $incentive_id_data as $key => $value){
    }
    if(!empty($this->incentive_type_id)&&!empty($this->qty)&&!empty($this->price)&&$this->max_discount>=0&&$this->max_discount!=null){
        $intnum=$value->incentive_type-$this->max_discount;
        $final = $intnum/100;
        $total =(float)$final;
        if(empty($this->amount_increase)){
            $this->amount_increase=0;
        }
        $amount = ($this->qty*($this->price+$this->amount_increase));
        if($this->max_discount>0){
            $amount1 = $amount/$this->max_discount;
        }
        else{
            $amount1 = 0;
        }
        $amount2 = $amount-$amount1;
        $final_total= ($amount2 * $total)/1.12;
        $this->incentive = round($final_total,2);
    }
    
}
    
    
    public function populateScopeDescription()
    {
            $this->scope_description = $this->general_procedure;
    }
    
    
    public function jo_no_id($jo_no_id)
    {
    // dd($jo_no_id);
        $this->jo_no_id = $jo_no_id;
        $data = JobOrder::find($jo_no_id);
        $this->reference_no_id = $data->reference_no;
        $find_costumer_numer = ClientProfile::where('id',$data->customer_id)->first();
        $MAX_DISCOUNT_MF = DiscountPercentage::Where('id',$find_costumer_numer['discount_mf'])->first();    //commented by william
        $int = intval($MAX_DISCOUNT_MF['percentage']);  //commented by william
        $this->display_max_discount = $int; //commented by william
    }

    public function addProduct()
    {
        $this->orderProducts[] = ['id_tools'=>'','work_order_id' => '','item_names' => '', 'quantity' => '', 'total' => ''];
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
        $this->job_type_id          = $workOrder->job_type_id;
        $this->jo_no_id             = $workOrder->jo_no_id;
        $this->reference_no_id      = $workOrder->reference_no_id;
        $this->mf_work_group_id     = $workOrder->mf_work_group_id;
        $this->mf_work_sub_type_id  = $workOrder->mf_work_sub_type_id;
        $this->general_procedure    = $workOrder->general_procedure;
        $this->scope_description    = $workOrder->scope_description;
        $this->process_group_id     = $workOrder->process_group_id;
        $this->process_subgroup_id  = $workOrder->process_subgroup_id;
        $this->machine_id           = $workOrder->machine_id;
        $this->process_cost         = $workOrder->process_cost;
        $this->remarks              = $workOrder->remarks;
        $this->parts_required_id    = $workOrder->parts_required_id;
        $this->hours                = $workOrder->hours;
        $this->qty                  = $workOrder->qty;
        $this->price                = $workOrder->price;
        $this->amount_increase      = $workOrder->amount_increase;
        $this->discount_id          = $workOrder->discount_id;
        $this->max_discount         = $workOrder->max_discount;
        $this->incentive_type_id    = $workOrder->incentive_type_id;
        $this->incentive            = $workOrder->incentive;
        $tools = WorkLoadUsedTools::all()->where('work_order_id', $this->Id);
        foreach ($tools as $tool){
            $this->orderProducts[$this->count] = ['id_tools'=>$tool->id,'work_order_id' => $tool->work_order_id,'item_names' => $tool->item_names, 'quantity' => $tool->quantity];
            $this->bagerror[$this->count] = [0];
            $this->count++;
        }

    }
   
    public function render()
    {
    $machines = Machines::select('id','machine_description_id','machine_group_id','machine_sub_group_id','machine_brand_id','capacity','machine_unit_id','arrival_date')->where('machine_dept_location_id',7)->with('getGroups','getAssignSubGroup','getMachineDescriptionName','getmachineunit','getmachinebrand')->get();
        return view('livewire.workorder.mf-work-order-form',[
            'workgroups' => SubGroup::whereIn('job_type_id',[1])->get(),
            'subType'    => WorkSubType::where('job_type_id',1)->get(),
            'generalprocedure' => GeneralProcedure::all(),
            'processgroup' => ProcessGroup::all(),
            'processsubgroup' => ProcessSubGroup::all(),
            'statuses' => Status::whereIn('id',[10,11])->get(),
            'discount' => Discount::all(),
            'incentive_types' => IncentiveType::all(),
            'select_items' => StockManagement::all(),
            'id_count' => WorkOrder::all()
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
        // dd($this->orderProducts);

        $data = $this->validate([
            'job_type_id'           => '',
            'jo_no_id'              => '',
            'reference_no_id'       => '',
            'mf_work_group_id'      => 'required',
            'mf_work_sub_type_id'   => 'required',
            'general_procedure'     => 'required',
            'scope_description'     => 'required',
            'process_group_id'      => '',
            'process_subgroup_id'   => 'required',
            'machine_id'            => '',
            'process_cost'          => 'numeric',
            'remarks'               => '',
            'parts_required_id'     => 'required',
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
        $data['job_type_id'] = 1;
        try
		{
		    $this->stockManagementService = $stockManagementService;
            if($this->Id){
                WorkOrder::find($this->Id)->update($data);
                $upadatedId = $this->Id;
                
                // dd($this->orderProducts);
                for ($i=0; $i < count($this->orderProducts); $i++) {
                    $item_price_name = StockManagement::where('id',$this->orderProducts[$i]['item_names'])->get();
                    //  dd($this->orderProducts[$i]['item_names']);
                    foreach($item_price_name as $key => $item_price)
                    $this->orderProducts[$i]['total']=$item_price['unit_price']*$this->orderProducts[$i]['quantity'];
                    if ($this->orderProducts[$i]['id_tools']=='') {
                        $this->orderProducts[$i]['work_order_id']=$upadatedId;
                        $this->stockManagementService->deductItem($this->orderProducts[$i]['item_names'], $this->orderProducts[$i]['quantity']);
                        WorkLoadUsedTools::create($this->orderProducts[$i]);
                    }else{
                        // dd($this->orderProducts[$i]['id_tools']);
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
            // dd($action);
            $this->emit('flashActionModal1',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Record Successfully Saved';
            // dd($action);
            $this->emit('flashActionModal1',$action,$message);
            
        }
        $this->resetInputFields();
        $this->emit('refreshAddWorkTable');
        $this->emit('closeMFModal');

    }
}