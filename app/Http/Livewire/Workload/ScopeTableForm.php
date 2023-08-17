<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\Scopes;
use App\Models\ErWorkGroup;
use App\Models\ErUnit;
use App\Models\SubGroup;

class ScopeTableForm extends Component
{
    public $scopeID, $er_work_group_id, $scope_name, $unit_id, $action, $message,
    $price_a=0,
    $price_b=0,
    $price_c=0,
    $price_d=0,
    $price_e=0,
    $price_f=0,
    $price_g=0,
    $price_h=0,
    $price_i=0,
    $price_j=0;


    protected $listeners = [
        'scopeID',
        'resetInputFieldsInScope',
        'job_type_id',
    ];

    public function resetInputFieldsInScope()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }


    public function scopeID($scopeID)
    {
        $this->scopeID = $scopeID;
        $scopeList = Scopes::find($scopeID);
        $this->scope_name = $scopeList->scope_name;
        $this->unit_id = $scopeList->unit_id;
        $this->price_a = $scopeList->price_a;
        $this->price_b = $scopeList->price_b;
        $this->price_c = $scopeList->price_c;
        $this->price_d = $scopeList->price_d;
        $this->price_e = $scopeList->price_e;
        $this->price_f = $scopeList->price_f;
        $this->price_g = $scopeList->price_g;
        $this->price_h = $scopeList->price_h;
        $this->price_i = $scopeList->price_i;
        $this->price_j = $scopeList->price_j;
        
    }

    public function render()
    {
        $workgoups = SubGroup::where('job_type_id',2)->get();
        $units = ErUnit::all();

        return view('livewire.workload.scope-table-form')
            ->with('workgoups', $workgoups)
            ->with('units',$units);
    }

    public function storeScope()
    {
        $data = $this->validate([
            'scope_name' => 'required',
            'er_work_group_id' => 'required',
            'unit_id' => '',
            'price_a' => '',
            'price_b' => '',
            'price_c' => '',
            'price_d' => '',
            'price_e' => '',
            'price_f' => '',
            'price_g' => '',
            'price_h' => '',
            'price_i' => '',
            'price_j' => '',
        ]);

        try {
            if ($this->scopeID) {
                Scopes::find($this->scopeID)->update($data);
            } else {
                Scopes::create($data);
            }
        } catch (\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }


        if ($this->scopeID) {
            $action = 'edit';
            $message = 'Scope Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Scope Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFieldsInScope();
        // $this->emit('refreshParent');
        $this->emit('closeScopeListModal');
    }
}