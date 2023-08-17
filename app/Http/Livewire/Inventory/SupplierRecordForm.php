<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Supplier;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SupplierRecordForm extends Component
{

    public $name, $email, $address, $contact_no, $contact_person, $supplierRecordId;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'supplierRecordId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function supplierRecordId($supplierRecordId)
    {
        $this->supplierRecordId = $supplierRecordId;
        $supplierRecord = Supplier::find($supplierRecordId);
        $this->name = $supplierRecord->name;
        $this->email = $supplierRecord->email;
        $this->address = $supplierRecord->address;
        $this->contact_no = $supplierRecord->contact_no;
        $this->contact_person = $supplierRecord->contact_person;
    }

    public function store()
    {
        $action = '';
        $data = $this->validate([
            'name' => 'required',
            'email' => ['nullable', 'email', Rule::unique('suppliers', 'email')->ignore($this->supplierRecordId)],
            'address' => 'required',
            'contact_no' => 'nullable',
            'contact_person' => 'nullable',
        ]);
        // dd($this->contact_no);
        try {
            if ($this->supplierRecordId) {
                Supplier::find($this->supplierRecordId)->update($data);
            } else {
                Supplier::create($data);
            }
        } catch (\Exception $e) {
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->supplierRecordId) {
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

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeSupplierRecordModal');
        return redirect()->to('/supplier-record');
    }

    public function render()
    {
        return view('livewire.inventory.supplier-record-form');
    }
}
