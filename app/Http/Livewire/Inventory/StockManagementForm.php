<?php

namespace App\Http\Livewire\Inventory;

use App\Enums\InventoryType as EnumsInventoryType;
use App\Enums\Status;
use App\Models\Department;
use App\Models\InventoryType;
use App\Models\LoanConsumeStatus;
use App\Models\StockManagement;
use App\Models\Supplier;
use App\Models\UnitType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class StockManagementForm extends Component
{
    use WithFileUploads;

    public $item_code, $supplier, $name, $description, $serial, $unit_price, $qty, $item_image, $stockManagementId, $brand, $inventory_type_id, $unit_type_id, $conversion_rate, $department_id, $acquisition_cost;
    public $isUploaded = false;
    public $change_images=false;
    public $action = '';
    public $message = '';
    public $loan_consume_ids = [];
    public $url, $link_one, $link_two;

    protected $listeners = [
        'stockManagementId',
        'resetInputFields',
        'selectedSupplier',
        'setUrl'
    ];

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function hydrate(){
        $this->emit('select2');
    }

    public function selectedSupplier($id)
    {
        $this->supplier = $id;
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function updatedItemImage()
    {
        if($this->stockManagementId){
            $this->change_images = true;
        }

        $this->isUploaded = true;
    }

    public function updatedAcquisitionCost($amount)
    {
        $amount = floatval(preg_replace('/[^\d.]/', '', $amount));
        $this->acquisition_cost = number_format($amount, 2);
        $this->unit_price = number_format(round($amount/ (.6)), 2);
    }

    public function updatedQty($qty){
        $this->qty = floatval(preg_replace('/[^\d.]/', '', $qty));
    }

    public function updatedUnitPrice($amount)
    {
        $amount = floatval(preg_replace('/[^\d.]/', '', $amount));
        $this->unit_price = number_format(round($amount), 2);
    }

    //edit
    public function stockManagementId($stockManagementId)
    {
        $this->stockManagementId = $stockManagementId;
        $stockManagement = StockManagement::find($stockManagementId);
        // $this->inventory_type_id = $stockManagement->inventory_type_id;
        $this->brand = $stockManagement->brand;
        $this->unit_type_id = $stockManagement->unit_type_id;
        $this->item_code = $stockManagement->item_code;
        $this->supplier = $stockManagement->supplier;
        $this->name = $stockManagement->name;
        $this->description = $stockManagement->description;
        $this->serial = $stockManagement->serial;
        $this->unit_price = number_format($stockManagement->unit_price, 2);
        $this->acquisition_cost = number_format($stockManagement->acquisition_cost, 2);
        $this->qty = $stockManagement->qty;
        $this->conversion_rate = $stockManagement->conversion_rate;
        $this->loan_consume_ids = unserialize($stockManagement->loan_consume_ids);
        $this->department_id = $stockManagement->department_id;
        $this->item_image = $stockManagement->item_image;
    }

    public function store()
    {

        if(!$this->stockManagementId || $this->change_images){
            $data = $this->validate([
                // 'inventory_type_id' => 'required',
                'brand' => 'required',
                'unit_type_id' => 'required',
                'item_code' => 'required',
                'supplier' => 'required',
                'name' => ['required', Rule::unique('stock_management', 'name')->ignore($this->stockManagementId)],
                'description' => 'required',
                'serial' => 'required',
                'unit_price' => 'required|regex:/\d{1,3}[,\\.]?(\\d{1,2})?/',
                'acquisition_cost' => 'required|regex:/\d{1,3}[,\\.]?(\\d{1,2})?/',
                'qty' => 'required',
                'conversion_rate' => 'required',
                'loan_consume_ids' => 'required',
                'department_id' => 'required',
                'item_image' => 'nullable|image|max:2000',
            ]);
        }else{
            $data = $this->validate([
                // 'inventory_type_id' => 'required',
                'brand' => 'required',
                'unit_type_id' => 'required',
                'item_code' => 'required',
                'supplier' => 'required',
                'name' => ['required', Rule::unique('stock_management', 'name')->ignore($this->stockManagementId)],
                'description' => 'required',
                'serial' => 'required',
                'unit_price' => 'required|regex:/\d{1,3}[,\\.]?(\\d{1,2})?/',
                'acquisition_cost' => 'required|regex:/\d{1,3}[,\\.]?(\\d{1,2})?/',
                'qty' => 'required',
                'conversion_rate' => 'required',
                'loan_consume_ids' => 'required',
                'department_id' => 'required',
            ]);
        }

        if(!$this->stockManagementId || $this->change_images){
            if (!empty($this->item_image)) {
                if ($this->isUploaded) {
                    $data['item_image'] = $this->uploadImage();
                }
            }
        }else{
            $data['item_image'] = $this->item_image;
        }

        $data['REP'] = $this->repNotification($this->qty);

        $data['loan_consume_ids'] = serialize($data['loan_consume_ids']);
        $data['inventory_type_id'] = EnumsInventoryType::SUPPLY;

        // Convert the string unit_price and price_adjustment into float bfore to save
        foreach ($data as $key => $value) {
            if($data['unit_price']){
                $data['unit_price'] = floatval(preg_replace('/[^\d.]/', '', $data['unit_price']));
            }
            if($data['acquisition_cost']){
                $data['acquisition_cost'] = floatval(preg_replace('/[^\d.]/', '', $data['acquisition_cost']));
            }
            if($data["unit_type_id" ]){
                $data['unit_type_id'] = (string) $data['unit_type_id'];
            }
            if($data["supplier" ]){
                $data['supplier'] = (string) $data['supplier'];
            }
        }

        try {
            if ($this->stockManagementId) {
                // dd($this->stockManagementId, $data);
                StockManagement::find($this->stockManagementId)->update($data);
            } else {
                // dd($data);
                StockManagement::create($data);
            }
        } catch (\Exception $e) {
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->stockManagementId) {
            $action = 'edit';
            $message = 'Stock Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Stock Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        if($this->url == "stock-management"){
            return redirect()->to('/stock-management');
        }
        $this->resetInputFields();
        $this->emit('refreshParentStockMngt');
        $this->emit('closeStockManagementModal');
        $this->emit('select2');
    }

    public function uploadImage()
    {
        $item_image = 'item_image.' . time() . $this->item_image->getClientOriginalName();

        $this->item_image->storeAs('public/images', $item_image);

        // $data['item_image'] = $item_image;
        return $item_image;
    }

    public function repNotification($qty)
    {
        // return 0 => > 11 qty
        // return 1 => < 10 qty
        // return 2 => == 0 qty
        if ($qty <= 10 && $qty > 0) {
            $action = 'refill';
            $message = 'Item is almost out of stock.';
            // dd($action);
            $this->emit('flashAction', $action, $message);
            return 1;
        } elseif ($qty <= 0) {
            $action = 'outofstock';
            $message = 'Item is out of stock.';
            // dd($action);
            $this->emit('flashAction', $action, $message);
            return 2;
        } else {
            return 0;
        }
    }

    public function render()
    {
        $this->url = $this->url ?? Route::current()->getName();

        return view('livewire.inventory.stock-management-form', [
            'suppliers' => Supplier::where('status_id', Status::ACTIVE)->get(),
            // 'inventory_types' => InventoryType::all(),
            'unit_types' => UnitType::all(),
            'loan_consume_status' => LoanConsumeStatus::all(),
            'departments' => Department::all(),
        ]);
    }
}
