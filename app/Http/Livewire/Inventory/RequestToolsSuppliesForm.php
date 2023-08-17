<?php

namespace App\Http\Livewire\Inventory;

use App\Enums\Status;
use App\Models\Contact;
use App\Models\JobOrder;
use App\Models\LoanConsumeStatus;
use App\Models\RequestTool;
use App\Models\RequestToolData;
use App\Models\StockManagement;
use App\Models\User;
use App\Models\WorkArea;
use Database\Seeders\LoanConsumeStatusSeeder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use PDO;

class RequestToolsSuppliesForm extends Component
{

    public $date, $supplier_id, $jo_no_id, $request_by_id, $all_total_price, $remarks, $all_total_qty, $requestToolsId, $viewRequestToolsId;
    public $work_area_id;
    public $listItems = [];
    public $request_type = [];
    public $consumes = [];
    public $products;
    public $custom_qty_error = [];
    public $has_jo, $hasSpareparts;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'requestToolsId',
        'resetInputFields',
        'requestToolsSuppliesDate',
        'viewRequestToolsId',
        'selectedJo',
        'selectedProduct',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
        $this->addItem();
    }

    public function hydrate(){
        $this->emit('select2');
    }

    public function selectedProduct($id, $index)
    {
        // dd($id, $index);
        $product = StockManagement::with('getDepartment')->find($id);

        $this->listItems[$index] = [
            'id' => $product->id,
            'item_name' => $product->id,
            'dept' => $product->getDepartment->name,
            'price' => $product->unit_price,
            'qty' => 1,
            'total' =>  $product->unit_price * $product->qty,
        ];

        $this->updated();
    }

    public function selectedJo($id)
    {
        if(!empty($id)){

            if($this->request_type){
                foreach ($this->request_type as $key => $value) {
                    if(in_array($value, [1,3,4,5])){
                        $this->jo_no_id = $id;
                    }
                }
            }
        }
    }

    public function viewRequestToolsId($requestToolsId)
    {
        $this->viewRequestToolsId = $requestToolsId;
        $requestTools = RequestTool::with('getRequestBy', 'requestToolsData.getStockManagment.getDepartment')->where('id', $requestToolsId)->first();
        $this->date = $requestTools->date;
        $this->request_by_id = $requestTools->getRequestBy->id;
        $this->jo_no_id = $requestTools->jo_no_id;

        // Request Types 
        $this->request_type = unserialize($requestTools->request_type);

        // RequestTools Data
        foreach ($requestTools->requestToolsData as $key => $value) {
            $this->listItems[$key] = [
                'id' => $value->getStockManagment->id,
                'item_name' => $value->getStockManagment->id,
                'dept' => $value->getStockManagment->getDepartment->name,
                'price' => $value->getStockManagment->unit_price,
                'qty' => $value->qty,
                'total' => $value->getStockManagment->unit_price * $value->qty,
            ];
        }
        
        $this->updatedRequestType($this->request_type);
        $this->updated();
    }

    public function requestToolsSuppliesDate($date)
    {
        $this->date = date('Y-m-d', strtotime($date));
    }

    public function mount()
    {
        $this->addItem();
    }

    public function addItem()
    {
        $this->listItems[] = [
            'id' => '',
            'item_name' => '',
            'dept' => '',
            'price' => '',
            'qty' => '',
            'total' =>  '',
        ];
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function getSpecificProduct($idProduct, $idList)
    {
        if (!empty($idProduct)) {
            $product = StockManagement::with('getDepartment')->find((int) $idProduct);
            $this->listItems[(int) $idList] = [
                'id' => $product->id,
                'item_name' => $product->id,
                'dept' => $product->getDepartment->name,
                'price' => $product->unit_price,
                'qty' => 1,
                'total' =>  $product->unit_price * $product->qty,
            ];

            // dd(number_format($this->listItems[0]['qty'] * (double) $this->listItems[0]['price'], 2));

            $this->updated();
        } else {

            $this->listItems[(int) $idList] = [
                'id' => '',
                'item_name' => '',
                'dept' => '',
                'price' => '',
                'qty' => '',
                'total' =>  '',
            ];

            $this->updated();
        }
    }

    public function updatedListItems($name, $value)
    {
        if (explode('.', $value)[1] == "item_name") {
            $this->getSpecificProduct($name, explode('.', $value)[0]);
        }
    }

    public function updated()
    {
        for($i = 0; $i < sizeof($this->listItems); $i++)
        {
            $this->listItems[$i]['qty'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['qty']));
            $this->listItems[$i]['price'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['price']));
        }

        $total = 0;
        $qty = 0;
        foreach ($this->listItems as $key => $item) {
            $this->listItems[$key]['total'] = is_numeric($item['qty']) && is_numeric($item['price'])
                ? $item['qty'] * $item['price']
                : 0;

            $total +=  round($this->listItems[$key]['total'], 2);
            $qty +=  round($this->listItems[$key]['qty'], 2);
            $this->listItems[$key]['total'] = number_format($this->listItems[$key]['total'], 2);
            // $this->listItems[$key]['price'] = $this->listItems[$key]['price'];
            // dd($this->listItems[$key]['qty'], $this->listItems[$key]['price']);
        }
        $this->all_total_price = $total;
        $this->all_total_qty = $qty;
        $this->all_total_price = number_format($this->all_total_price, 2);

        for($i = 0; $i < sizeof($this->listItems); $i++)
        {
            $this->listItems[$i]['price'] = number_format($this->listItems[$i]['price'], 2);
        }
    }

    public function updatedRequestType($id)
    {
        $this->consumes = [];

        $this->hasSpareparts = false;
        foreach ($this->request_type as $key => $value) {
            if(in_array($value, [3,5])){
                $this->hasSpareparts = true;
            }
        }

        $this->has_jo = false;
        if($this->request_type){
            foreach ($this->request_type as $key => $value) {
                if(in_array($value, [1,3,4,5])){
                    $this->has_jo = true;
                }
            }
        }

        if(!in_array($this->request_type, $id)){
            $this->request_type = $id;
            $this->request_type = array_values($this->request_type);

            $stock_products = StockManagement::all();
            foreach ($stock_products as $key => $value) {
                $merge = array_merge(unserialize($value->loan_consume_ids), $this->request_type);

                $duplicates =
                    array_unique(
                        array_diff_key(
                            $merge,
                            array_unique($merge)
                        )
                    );

                if(count($duplicates) > 0){
                    $this->consumes[$key] = $value->id;
                }
            }

            $this->products = StockManagement::withTrashed()->whereIn('id', $this->consumes)->get();
        }

        if(empty($this->request_type)){
            $this->listItems = [];
            $this->jo_no_id = null;
            $this->addItem();
            $this->updated();
        }

    }

    //edit
    public function requestToolsId($requestToolsId)
    {
        $this->requestToolsId = $requestToolsId;
        $requestTools = RequestTool::with('getRequestBy', 'requestToolsData.getStockManagment.getDepartment')->where('id', $requestToolsId)->first();
        $this->date = $requestTools->date;
        $this->request_by_id = $requestTools->getRequestBy->id;
        $this->jo_no_id = $requestTools->jo_no_id;

        // Request Types 
        $this->request_type = unserialize($requestTools->request_type);

        // RequestTools Data
        foreach ($requestTools->requestToolsData as $key => $value) {
            $this->listItems[$key] = [
                'id' => $value->getStockManagment->id,
                'item_name' => $value->getStockManagment->id,
                'dept' => $value->getStockManagment->getDepartment->name,
                'price' => $value->getStockManagment->unit_price,
                'qty' => $value->qty,
                'total' => $value->getStockManagment->unit_price * $value->qty,
            ];
        }
        
        $this->updatedRequestType($this->request_type);
        $this->updated();
    }

    public function store()
    {

        $this->custom_qty_error = [];
        $this->has_jo = false;
        if($this->request_type){
            foreach ($this->request_type as $key => $value) {
                if(in_array($value, [1,3,4,5])){
                    $this->has_jo = true;
                }
            }
        }
        
        if($this->has_jo){
            $data = $this->validate([
                'date' => 'required',
                'request_type' => 'required',
                'jo_no_id' => 'required',
                'work_area_id' => '',
                'request_by_id' => 'required',
                'remarks' => 'nullable',
            ]);
        }else{
            $data = $this->validate([
                'date' => 'required',
                'request_type' => 'required',
                'jo_no_id' => 'nullable',
                'work_area_id' => '',
                'request_by_id' => 'required',
                'remarks' => 'nullable',
            ]);
        }

        // custom validation of the qty inputs is greater than the number of the qty
        foreach ($this->listItems as $key => $value) {
            $result = StockManagement::where('id', $value['item_name'])->first();

            if($result != null && $value['qty'] > $result->qty){
                $this->custom_qty_error[$key] = true;
            }
        }

        if(!empty($this->custom_qty_error)){
            return back();
        }

        foreach ($this->listItems as $key => $value) {
            if($this->listItems[$key]['price']){
                $this->listItems[$key]['price'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['price']));
            }
            if($this->listItems[$key]['total']){
                $this->listItems[$key]['total'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['total']));
            }
        }

        $data['request_type'] = serialize($data['request_type']);
        $data['status_id'] = 1;

        try {

            if($this->requestToolsId){
                // UPDATEORCREATE FUNCTIONALITY
                RequestTool::where('id', $this->requestToolsId)->update($data);

                foreach ($this->listItems as $key => $value) {
                    RequestToolData::updateOrCreate([
                        'request_tool_id' => $this->requestToolsId,
                        'item_id' => $value['item_name'],
                    ], [
                        'request_tool_id' => $this->requestToolsId,
                        'item_id' => $value['item_name'],
                        'qty' => $value['qty'],
                        'update_request_tool_data' => 1,
                        'request_tool_arrangement' => $key,
                        'selling_price' => $value['price'],
                    ]);
                }
                
                // Delete product that is false
                foreach ($this->listItems as $key => $value) {
                    RequestToolData::where('request_tool_id', '=', $this->requestToolsId)
                    ->where('update_request_tool_data', '=', 0)
                    ->delete();
                }

                // Return back all product back to false
                foreach ($this->listItems as $key => $value) {
                    RequestToolData::where('request_tool_id', '=', $this->requestToolsId)
                    ->where('item_id', '=', $value['item_name'])
                    ->update([
                        'update_request_tool_data' => 0,
                    ]);
                }


            }else{
                // Create Request Tools
                $request_tools = RequestTool::create($data);

                // Create RequestToolsData
                foreach ($this->listItems as $key => $value) {
                    RequestToolData::create([
                        'request_tool_id' => $request_tools->id,
                        'item_id' =>$value['item_name'],
                        'qty'   => $value['qty'],
                        'selling_price' => $value['price'],
                    ]);
                }
            }
        } catch (\Throwable $th) {
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->requestToolsId) {
            $action = 'edit';
            $message = 'Request Tools Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Request Tools Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeRequestToolsSuppliesModal');
        return redirect()->to('/request-tools-supplies');
        

    }

    public function deleteItem($index)
    {
        unset($this->listItems[$index]);
        $this->listItems = array_values($this->listItems);
        $this->updated();
    }

    public function render()
    {
        return view('livewire.inventory.request-tools-supplies-form', [
            'loan_consumables' => LoanConsumeStatus::all(),
            'job_orders' => JobOrder::whereIn('status', [Status::PENDING, Status::APPROVED, Status::PROCESSING, Status::DONE])->get(),
            'requests' => User::role(['operator', 'admin', 'encoder'])->where('status_id', 14)->get()->except([1,13]),
            'products' => StockManagement::whereIn('id', $this->consumes)->get() ?? null,
            'work_area' => WorkArea::all()
        ]);
    }
}
