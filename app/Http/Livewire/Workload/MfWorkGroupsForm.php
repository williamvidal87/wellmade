<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\MfworkGroup;

class MfWorkGroupsForm extends Component
{
    public  $Id, $mf_work_group_name;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'Id',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }


    //edit
    public function Id($id){      
        $this->Id = $id;     
        $workGroup = MfworkGroup::find($id);
        $this->mf_work_group_name = $workGroup->mf_work_group_name;
    }

    public function render()
    {
        return view('livewire.workload.mf-work-groups-form');
    }


    public function store()
    {
        $data = $this->validate([
            'mf_work_group_name' => 'required',
        ]);

        try {
            if ($this->Id) {
                MfworkGroup::find($this->Id)->update($data);
            } else {
                MfworkGroup::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }


        if ($this->Id) {
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
        $this->emit('closeModal');
    }
}
