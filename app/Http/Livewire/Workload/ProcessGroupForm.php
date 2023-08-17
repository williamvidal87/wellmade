<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\ProcessGroup;


class ProcessGroupForm extends Component
{
    public $Id, $process_group_name;

    protected $listeners = [
        'Id',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function Id($Id)
    {
        $this->Id = $Id;
        $data = ProcessGroup::find($Id);
        $this->process_group_name = $data->process_group_name;
    }
    
    public function render()
    {
        return view('livewire.workload.process-group-form');
    }

    public function store()
    {
        $data = $this->validate([
            'process_group_name' => 'required',
        ]);

        try {
            if ($this->Id) {
                ProcessGroup::find($this->Id)->update($data);
            } else {
                ProcessGroup::create($data);
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
        $this->emit('closeProcessGroupModal');
    }

}
