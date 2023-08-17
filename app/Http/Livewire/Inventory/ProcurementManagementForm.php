<?php

namespace App\Http\Livewire\Inventory;

use App\Enums\Status;
use App\Models\ProcurementItems;
use App\Models\PurchaseOrder;
use App\Models\StockManagement;
use App\Models\Supplier;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Validation\Rule;

class ProcurementManagementForm extends Component
{
    public $date, $pr_no, $supplier_id, $unit, $qty, $price, $status, $remarks, $procurementManagementId, $product, $pr_id, $viewProcurementManagement;
    public $total_price = '';
    public $all_total_price = '';
    public $listItems = [];
    public $oldItems = [];
    public $allProducts;
    public $optionSelect = false;
    public $products = [];

    protected $listeners = [
        'refreshParentStockMngt' => '$refresh',
        'addProduct',
        'procurementManagementId',
        'resetInputFields',
        'selectChange',
        'procurementNumber',
        'viewProcurementManagement',
        'selectedSupplierId',
        'selectedProduct',
    ];

    public function addStock($id){
        $this->emit('selectedSupplier', (int) $id);
        $this->emit('openStockManagementModal');
    }

    public function hydrate(){
        $this->emit('select2');
    }

    public function selectedProduct($id, $index)
    {
        $product = StockManagement::with('unitTypes')->get();
        $product = $product->find($id);
        $this->listItems[$index] = [
            'pr_id' => null,
            'product' => $id,
            'qty' => 1,
            'unit' => $product->unitTypes->longdescription,
            'price' => $product->acquisition_cost,
            'total_price' => ($product->qty * $product->acquisition_cost),
        ];
        $this->updated();
    }

    public function selectedSupplierId($id)
    {
        $this->supplier_id = $id;
        $this->listItems = [];
        $this->addItem();
        $this->updated();
        $this->products = StockManagement::where('supplier', (int) $id)->get();
    }

    public function viewProcurementManagement($procurementManagementId)
    {
        $this->viewProcurementManagement = $procurementManagementId;
        $procurement = PurchaseOrder::with('getProcurementItems')->where('id', $procurementManagementId)->first();
        $this->date = $procurement->date;
        $this->pr_no = $procurement->pr_no;
        $this->supplier_id = $procurement->supplier_id;
        $this->remarks = $procurement->remarks;
        $this->all_total_price = $procurement->all_total_price;

        // RequestTools Data
        foreach ($procurement->getProcurementItems as $key => $value) {
            $this->listItems[$key] = [
                'pr_id' => $procurementManagementId, //new
                'product' => $value->stock_id,
                'qty' => $value->qty,
                'unit' => $value->unit,
                'price' => $value->price,
                'total_price' => $value->total_price,
            ];
        }
        
        // $this->updatedRequestType($this->request_type);
        $this->updated();
    }

    public function procurementNumber($pr_no, $date)
    {
        $this->pr_no = $pr_no;
        $this->date = date('Y-m-d', strtotime($date));
    }

    public function printReports($id)
    {        
        $report_data = PurchaseOrder::where('id', $id)->with('suppliers')->get();  
        $items = ProcurementItems::where('pr_id', $id)->with('stockManagement')->get();
        $pdf  = PDF::loadView('livewire.procurement-print.procurement-management', ['report_data' => $report_data, 'items' => $items])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"procurement-management.pdf"
        );    
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
        $this->addItem();
    }

    public function mount()
    {
        $this->addItem();
    }

    //dispable
    public function selectNull()
    {
        $this->emit('disableOption');
    }

    public function getSpecificProduct($idProduct, $idList)
    {
        if (!empty($idProduct)) {
            // $product = StockManagement::with('unitTypes')->find((int) $idProduct)->get();
            $product = StockManagement::with('unitTypes')->get();
            $product = $product->find((int) $idProduct);
            $this->listItems[(int) $idList] = [
                'pr_id' => null,
                'product' => $idProduct,
                'qty' => 1,
                'unit' => $product->unitTypes->longdescription,
                'price' => $product->acquisition_cost,
                'total_price' => ($product->qty * $product->acquisition_cost),
            ];
            $this->updated();
        } else {

            $this->listItems[(int) $idList] = [
                'pr_id' => null,
                'product' => null,
                'qty' => '',
                'unit' => '',
                'item_name' =>  '',
                'description' =>  '',
                'price' =>  '',
                'total_price' => '',
            ];
            $this->updated();
        }
    }

    public function updatedListItems($name, $value)
    {
        if (explode('.', $value)[1] == "product") {
            $this->getSpecificProduct($name, explode('.', $value)[0]);
        }

        $this->optionSelect = true;
    }


    public function updated()
    {

        for($i = 0; $i < sizeof($this->listItems); $i++)
        {
            $this->listItems[$i]['qty'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['qty']));
            $this->listItems[$i]['price'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['price']));
        }

        $total = 0;
        foreach ($this->listItems as $key => $item) {
            $this->listItems[$key]['total_price'] = is_numeric($item['qty']) && is_numeric($item['price'])
                ? $item['qty'] * $item['price']
                : 0;

            $total +=  round($this->listItems[$key]['total_price'], 2);
            $this->listItems[$key]['total_price'] = number_format($this->listItems[$key]['total_price'], 2);
        }
        $this->all_total_price = $total;
        $this->all_total_price = number_format($this->all_total_price, 2);

        for($i = 0; $i < sizeof($this->listItems); $i++)
        {
            $this->listItems[$i]['price'] = number_format($this->listItems[$i]['price'], 2);
        }
    }

    //edit
    public function procurementManagementId($procurementManagementId)
    {
        $this->listItems = [];
        $this->procurementManagementId = $procurementManagementId;
        $procurements = ProcurementItems::with('purchaseOrder')->where('pr_id', $procurementManagementId)->orderBy('product_arrangement')->get();

        $i = 0;
        foreach ($procurements as $value) {
            $this->listItems[$i] = [
                'pr_id' => $procurementManagementId, //new
                'product' => $value->stock_id,
                'qty' => $value->qty,
                'unit' => $value->unit,
                'price' => $value->price,
                'total_price' => $value->total_price,
            ];
            $this->oldItems[$i] = [
                'pr_id' => $procurementManagementId, //new
                'product' => $value->stock_id,
                'qty' => $value->qty,
                'unit' => $value->unit,
                'price' => $value->price,
                'total_price' => $value->total_price,
            ];
            $i++;
        }

        $procurements = PurchaseOrder::find($procurementManagementId);
        $fields = ['date', 'pr_no', 'supplier_id', 'remarks', 'all_total_price'];
        for ($i = 0; $i < sizeof($fields); $i++) {
            $this->{$fields[$i]} = $procurements->{$fields[$i]};
        }

        $product = StockManagement::where('supplier', (int) $this->supplier_id)->withTrashed()->get();
        $this->products = $product;

        $this->selectNull();
        $this->oldItems = $this->listItems;
        $this->updated();
    }

    public function store()
    {
        $data = $this->validate([
            'date' => 'required',
            'pr_no' => ['required', Rule::unique('purchase_orders', 'pr_no')->ignore($this->procurementManagementId)],
            'supplier_id' => 'required',
            'remarks' => '',
            'all_total_price' => 'required',
        ]);

        if(floatval(preg_replace('/[^\d.]/', '', $data['all_total_price'])) > 500){
            $data['status_id'] = Status::PENDING;
        }else if(floatval(preg_replace('/[^\d.]/', '', $data['all_total_price'])) <= 500){
            $data['status_id'] = Status::APPROVED;
        }

        $data['user_id'] = auth()->user()->id;
        $data['all_total_price'] = $this->all_total_price;

        try {
            if ($this->procurementManagementId) {

                    // Get all the product id from listItems
                    $listItemProductId = [];
                    foreach ($this->listItems as $item) {
                        if (empty($item['product'])) {
                        } else {
                            $listItemProductId[] = (int) $item['product'];
                        }
                    }

                    // Get all the product id from oldItems
                    $oldItemProductId = [];
                    foreach ($this->oldItems as $item) {
                        $oldItemProductId[] = $item['product'];
                    }

                    // Convert the string all total price into float bfore to save
                    for ($i=0; $i < sizeof($data); $i++) {
                        $data['all_total_price'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_price']));
                    }

                    // Convert the string price and total price into float bfore to save
                    foreach ($this->listItems as $key => $value) {
                        if($this->listItems[$key]['price']){
                            $this->listItems[$key]['price'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['price']));
                        }
                        if($this->listItems[$key]['total_price']){
                            $this->listItems[$key]['total_price'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['total_price']));
                        }
                    }

                    // Update product to true in update product column
                    foreach ($this->listItems as $key => $value) {
                        ProcurementItems::updateOrCreate([
                        'pr_id' => $this->procurementManagementId,
                        'stock_id' => (int) $this->listItems[$key]['product']
                        ], [
                            'pr_id' => $this->procurementManagementId,
                            'stock_id' => (int) $this->listItems[$key]['product'],
                            'qty' => $this->listItems[$key]['qty'],
                            'unit' => $this->listItems[$key]['unit'],
                            'update_product' => 1,
                            'product_arrangement' => $key,
                            'price' => $this->listItems[$key]['price'],
                            'total_price' => $this->listItems[$key]['total_price'],
                        ]);
                    }

                    // Delete product that is false
                    foreach ($this->listItems as $key => $value) {
                        ProcurementItems::where('pr_id', '=', $this->procurementManagementId)
                        ->where('update_product', '=', 0)
                        ->delete();
                    }

                    // Return back all product back to false
                    foreach ($this->listItems as $key => $value) {
                        ProcurementItems::where('pr_id', '=', $this->procurementManagementId)
                        ->where('stock_id', '=', (int) $this->listItems[$key]['product'])
                        ->update([
                            'update_product' => 0,
                        ]);
                    }

                    if (sizeof($this->listItems) == 0) {
                        //Delete if the purchase order if user remove all the products in the edit
                        PurchaseOrder::destroy($this->procurementManagementId);
                    }

                    // Update the purchase order to the latest data
                    PurchaseOrder::where('id', $this->procurementManagementId)->update($data);
                    
            } else {
                // Convert the string all total price into float bfore to save
                for ($i=0; $i < sizeof($data); $i++) {
                    $data['all_total_price'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_price']));
                }

                $data = PurchaseOrder::create($data);

                // Convert the string price and total price into float bfore to save
                foreach ($this->listItems as $key => $value) {
                    if($this->listItems[$key]['price']){
                        $this->listItems[$key]['price'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['price']));
                    }
                    if($this->listItems[$key]['total_price']){
                        $this->listItems[$key]['total_price'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['total_price']));
                    }
                }

                foreach ($this->listItems as $key => $value) {
                    ProcurementItems::insert([
                        'pr_id' => $data->id,
                        'stock_id' => (int) $value['product'],
                        'qty' => $value['qty'],
                        'unit' => $value['unit'],
                        'product_arrangement' => $key,
                        'price' => $value['price'],
                        'total_price' => $value['total_price'],
                    ]);
                }

                if(floatval(preg_replace('/[^\d.]/', '', $data['all_total_price'])) <= 500){
                    // Add the procurement items qty into the stock qty
                    $purchase_order = PurchaseOrder::with('getProcurementItems.stockManagement')->where('id',$data->id)->first();
                    foreach ($purchase_order->getProcurementItems as $key => $value) {
                        foreach ($value->stockManagement as $key => $data) {
                            if($data->qty + $value->qty <= 10 && $data->qty + $value->qty > 0){
                                StockManagement::where('id', $value->stock_id)->update([
                                    'qty' => $data->qty + $value->qty,
                                    'REP' => 1 // less than 10 qty and greater than 0
                                ]);
                            } elseif ($data->qty + $value->qty <= 0) {
                                StockManagement::where('id', $value->stock_id)->update([
                                    'qty' => $data->qty + $value->qty,
                                    'REP' => 2 // less than or equal to 0 qty
                                ]);
                            }else{
                                StockManagement::where('id', $value->stock_id)->update([
                                    'qty' => $data->qty + $value->qty,
                                    'REP' => 0 // greater than or equal to 11
                                ]);
                            }
                        }
                    }
                }

            }
        } catch (\Exception $e) {
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->procurementManagementId) {
            $action = 'edit';
            $message = 'Procurement Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Procurement Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeProcurementManagementModal');
    }

    public function render()
    {
        $this->products = StockManagement::where('supplier', (int) $this->supplier_id)->get();
        return view('livewire.inventory.procurement-management-form', [
            'suppliers' => Supplier::where('status_id', Status::ACTIVE)->get(),
            'products' => $this->products,
        ]);
    }

    public function addItem()
    {
        $this->listItems[] = [
            'pr_id' => null, //new for delete default value just to make it run
            'product' => null, //new for delete default value just to make it run
            'qty' => '',
            'unit' => '',
            'item_name' =>  '',
            'description' =>  '',
            'price' =>  '',
            'total_price' => '',
        ];
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    // disable options
    public function selectChange($value){
        $this->emit('disableOption');
    }

    public function deleteItem($index)
    {
        unset($this->listItems[$index]);
        $this->listItems = array_values($this->listItems);
        $this->updated();
    }
}
