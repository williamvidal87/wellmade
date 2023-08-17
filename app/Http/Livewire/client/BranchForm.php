<?php

namespace App\Http\Livewire\client;

use App\Models\Branch;
use Livewire\Component;

class BranchForm extends Component
{

    public $branch_name, $branchId;
    public $company_name, $address, $owner_name, $contact_no;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'branchId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function branchId($branchId)
    {
        $this->branchId = $branchId;
        $branches = Branch::find($branchId);
        $this->company_name = $branches->company_name;
        $this->branch_name = $branches->branch_name;
        $this->address = $branches->address;
        $this->contact_no = $branches->contact_no;
        $this->owner_name = $branches->owner_name;
    }

    public function store()
    {

        $data = $this->validate([
            'company_name'=> '',
            'branch_name' => 'required',
            'address'=> '',
            'contact_no'=> '',
            'owner_name'=> ''
        ]);

        try {
            if ($this->branchId) {
                Branch::find($this->branchId)->update($data);
            } else {
                Branch::create($data);
            }
        } catch (\Exception $e) {
            return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
        }

        if ($this->branchId) {
            $action = 'edit';
            $message = 'Branch Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Branch Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeBranchModal');
    }

    public function render()
    {
        return view('livewire.client.branch-form');
    }
}
