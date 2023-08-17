<?php

namespace App\Http\Livewire\Workload;

use App\Models\JobTypes;
use Livewire\Component;
use App\Models\SubGroupRates;
use App\Models\SubGroup;

class SubGroupRateForm extends Component
{
    public $slug, $subgrouprateId, $sub_group ,$group_id;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'subgrouprateId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
    }

    public function subgrouprateId($subgrouprateId)
    {
        $this->subgrouprateId = $subgrouprateId;
        $subgrouprate = SubGroupRates::find($subgrouprateId);
        $this->sub_group = $subgrouprate->sub_group;
        $this->group_id = $subgrouprate->group_id;
    }

    public function render()
    {
        return view('livewire.workload.sub-group-rate-form',[
            'SubGroup'  => SubGroup::all()
        ]);
    }


    public function store()
    {
        $data = $this->validate([
            'sub_group' => 'required',
            'group_id' => 'required',
        ]);
        try {
            if ($this->subgrouprateId) {
                SubGroupRates::find($this->subgrouprateId)->update($data);
            } else {
                SubGroupRates::create($data);
            }
        }catch (\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }
        if ($this->subgrouprateId) {
            $action = 'edit';
            $message = 'Sub Group Rates Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Sub Group Rates Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeSubgrouprateModal');
    }
}
