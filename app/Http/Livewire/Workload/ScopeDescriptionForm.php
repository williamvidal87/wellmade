<?php

namespace App\Http\Livewire\Workload;

use App\Models\GeneralProcedure;
use App\Models\SubGroupRates;
use Livewire\Component;
use App\Models\ScopeDescription;

class ScopeDescriptionForm extends Component
{
    public $slug, $scopedescriptionId, $sub_type_id, $scope_description_name,$general_procedure_id;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'scopedescriptionId',
        'resetInputFields'
    ];

    public function scopedescriptionId($scopedescriptionId)
    {
        $this->scopedescriptionId = $scopedescriptionId;
        $ScopeDescription = ScopeDescription::find($scopedescriptionId);
        $this->sub_type_id = $ScopeDescription->sub_type_id;
        $this->scope_description_name = $ScopeDescription->scope_description_name;
        $this->general_procedure_id = $ScopeDescription->general_procedure_id;
    }
    
    
    public function resetInputFields()
    {
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.workload.scope-description-form',[
        'subtypes' => SubGroupRates::whereIn('id',[26,27])->get(),
        'general_procedure' => GeneralProcedure::all()
        ]);
    }


    public function store()
    {

        $data = $this->validate([
            'sub_type_id' => 'required',
            'scope_description_name' => 'required',
            'general_procedure_id'  =>'',
        ]);

        try {
            if ($this->scopedescriptionId) {
                ScopeDescription::find($this->scopedescriptionId)->update($data);
            } else {
                ScopeDescription::create($data);
            }
        } catch (\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->scopedescriptionId) {
            $action = 'edit';
            $message = 'Scope Description Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Scope Description Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeScopeDescriptionModal');
        $this->emit('scopedescriptionTable');
       
    }
}
