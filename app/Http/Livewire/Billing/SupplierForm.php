<?php

namespace App\Http\Livewire\Billing;

use App\Models\BillingSupplier;
use App\Models\ChartOfAccounts;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class SupplierForm extends Component
{

    public $name, $address, $contact_number, $supplierId, $url;
    public $journalize = [];

    public $action = '';
    public $message = '';

    protected $listeners = [
        'supplierId',
        'resetInputFields',
        'setUrl',
    ];

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function supplierId($supplierId)
    {
        $this->supplierId = $supplierId;
        $supplier = BillingSupplier::find($supplierId);
        $this->name = $supplier->name;
        $this->address = $supplier->address;
        $this->contact_number = $supplier->contact_number;
        // Request Types 
        $this->journalize = unserialize($supplier->journalize);
    }

    public function store()
    {

        $data = $this->validate([
            'name' => ['required', Rule::unique('billing_suppliers', 'name')->ignore($this->supplierId)],
            'address' => 'nullable',
            'contact_number' => 'nullable',
            'journalize' => 'nullable',
        ]);

        $data['journalize'] = serialize($data['journalize']);
        
        try {
            if ($this->supplierId) {
                $supplier = BillingSupplier::find($this->supplierId);
                $supplier->update($data);
            } else {
                BillingSupplier::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->supplierId) {
            $action = 'edit';
            $message = 'Supplier Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Supplier Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        if($this->url == "supplier"){
            return redirect()->to('/supplier');
        }
        $this->resetInputFields();
        $this->emit('refreshParentCheckVoucher');
        $this->emit('closeSupplier');
    }

    public function render()
    {
        $this->url = $this->url ?? Route::current()->getName();
        return view('livewire.billing.supplier-form', [
            'chart_of_accounts' => ChartOfAccounts::all(),
        ]);
    }
}
