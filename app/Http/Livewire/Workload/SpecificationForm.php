<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\Specifications;

class SpecificationForm extends Component
{
    public $specificationListID, $specification_name, $action, $message;

    protected $listeners = [
        'specificationID',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function specificationID($specificationID)
    {
        $this->specificationListID = $specificationID;
        $specificationList = Specifications::find($specificationID);
        $this->specification_name = $specificationList->specification_name;
    }

    public function render()
    {
        return view('livewire.workload.specification-form');
    }

    public function tablemodal()
    {
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeMachineandFabricationListModal');
    }

    public function store()
    {
        $data = $this->validate([
            'specification_name' => 'required',
        ]);

        try {
            if ($this->specificationListID) {
                Specifications::find($this->specificationListID)->update($data);
            } else {
                Specifications::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->specificationListID) {
            $action = 'edit';
            $message = 'Permission Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Permission Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeSpecificationListModal');
    }
}