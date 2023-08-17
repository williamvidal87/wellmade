<?php

namespace App\Http\Livewire\Inventory;

use App\Enums\InventoryType as EnumsInventoryType;
use App\Models\Department;
use App\Models\InventoryType;
use App\Models\LoanConsumeStatus;
use App\Models\StockManagement;
use App\Models\Supplier;
use App\Models\UnitType;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class StockForm extends Component
{

    use WithFileUploads;

    public $item_code, $supplier, $name, $description, $serial, $unit_price, $qty, $item_image, $stockManagementId, $brand, $inventory_type_id, $unit_type_id, $conversion_rate, $department_id;
    public $isUploaded = false;
    public $change_images=false;
    public $action = '';
    public $message = '';
    public $loan_consume_ids = [];

    protected $listeners = [
        'stockManagementId',
        'resetInputFields',
        'newStockSupplier',
    ];

    public function newStockSupplier($id)
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

    public function updatedUnitPrice($amount)
    {
        $amount = floatval(preg_replace('/[^\d.]/', '', $amount));
        $this->unit_price = number_format($amount, 2);
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
                'qty' => 'required',
                'conversion_rate' => 'required',
                'loan_consume_ids' => 'required',
                'department_id' => 'required',
                // 'item_image' => 'required|mimes:jpg,jpeg,png|max:2000',
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
                'qty' => 'required',
                'conversion_rate' => 'required',
                'loan_consume_ids' => 'required',
                'department_id' => 'required',
                'item_image' => '',
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
            // if($data["inventory_type_id" ]){
            //     $data['inventory_type_id'] = (string) $data['inventory_type_id'];
            // }
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
            // $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Stock Successfully Saved';
            // dd($action);
            // $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        // $this->emit('refreshParent');
        $this->emit('refreshParentProcurement');
        // $this->emit('closeStockManagementModal');
        $this->emit('closeStockModal');
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
        return view('livewire.inventory.stock-form', [
            'suppliers' => Supplier::all(),
            // 'inventory_types' => InventoryType::all(),
            'unit_types' => UnitType::all(),
            'loan_consume_status' => LoanConsumeStatus::all(),
            'departments' => Department::all(),
        ]);
    }
}
