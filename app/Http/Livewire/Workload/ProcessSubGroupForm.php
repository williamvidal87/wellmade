<?php

namespace App\Http\Livewire\Workload;

use App\Models\ProcessGroup;
use Livewire\Component;
use App\Models\ProcessSubGroup;

class ProcessSubGroupForm extends Component
{
    public $slug, $processsubgroupId, $process_group_id, $process_sub_group_name;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'processsubgroupId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
    }

    public function processsubgroupId($processsubgroupId)
    {
        $this->processsubgroupId = $processsubgroupId;
        $processsubgroup = ProcessSubGroup::find($processsubgroupId);
        $this->process_group_id = $processsubgroup->process_group_id;
        $this->process_sub_group_name = $processsubgroup->process_sub_group_name;
    }

    public function render()
    {
        return view('livewire.workload.process-sub-group-form',[
        'groups' => ProcessGroup::all()
        ]);
    }


    public function store()
    {

        $data = $this->validate([
            'process_group_id' => 'required',
            'process_sub_group_name' => 'required',
        ]);

        $data['guard_name'] = 'web';

        try {
            if ($this->processsubgroupId) {
                ProcessSubGroup::find($this->processsubgroupId)->update($data);
            } else {
                ProcessSubGroup::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->processsubgroupId) {
            $action = 'edit';
            $message = 'Process Sub Group Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Process Sub Group Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeProcessSubGroupModal');
    }
}
