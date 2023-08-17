<?php

namespace App\Http\Livewire\JOMS;

use App\Models\JobTypes;
use Livewire\Component;

class JOTypeForm extends Component
{
    public $jobtypeID, $abbriv_code, $description;

    protected $listeners = [
        'jobtypeID',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
    }

    public function jobtypeID($jobtypeID)
    {
        $this->jobtypeID = $jobtypeID;
        $forjobtype = JobTypes::find($jobtypeID);
        $this->abbriv_code = $forjobtype->abbriv_code;
        $this->description = $forjobtype->description;
    }

    public function render()
    {
        return view('livewire.j-o-m-s.j-o-type-form');
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
            'abbriv_code' => 'required',
            'description' => 'required',
        ]);

        try {
            if ($this->jobtypeID) {
                JobTypes::find($this->jobtypeID)->update($data);
            } else {
                JobTypes::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->jobtypeID) {
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
        $this->emit('closeJobTypeModal');
    }
}