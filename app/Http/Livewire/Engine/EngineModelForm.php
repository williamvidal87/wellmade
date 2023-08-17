<?php

namespace App\Http\Livewire\Engine;

use App\Models\CategoryList;
use App\Models\CylinderList;
use App\Models\EngineModel;
use App\Models\MakeList;
use App\Models\Type;
use App\Models\Valve;
use App\Models\YearMade;
use Livewire\Component;

class EngineModelForm extends Component
{
    public $slug, $enginemodelID, $model, $year_made_id, $make_id, $category_id, $cylinder_id, $valve_id;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'enginemodelID',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
        // Edit Find
    public function enginemodelID($enginemodelID){
        $this->enginemodelID = $enginemodelID;
        $enginemodel = EngineModel::find($enginemodelID);
        $this->model = $enginemodel->model;
        $this->year_made_id = $enginemodel->year_made_id;
        $this->make_id = $enginemodel->make_id;
        $this->category_id = $enginemodel->category_id;
        $this->cylinder_id = $enginemodel->cylinder_id;
        $this->valve_id = $enginemodel->valve_id;
    }
        // Edit Find End

    public function render()
    {
        return view('livewire.engine.engine-model-form',[
            'yearmade'      => YearMade::all(),
            'makes'         => MakeList::all(),
            'category'      => CategoryList::all(),
            'cylinder'      => CylinderList::all(),
            'valves'        => Valve::all()
        ]);
    }

    
    public function store(){

        $data = $this->validate([
            'model'         => 'required',
            'year_made_id'  => '',
            'make_id'       => 'required',
            'category_id'   => 'required',
            'cylinder_id'   => 'required',
            'valve_id'      => 'required',
        ]);

        try
		{
            if($this->enginemodelID){
                EngineModel::find($this->enginemodelID)->update($data);
            }else{
                EngineModel::create($data);
            }

		} catch (\Exception $e) {
			dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->enginemodelID){
            $action = 'edit';
            $message = 'Engine Model Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Engine Model Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeEngineModelModal');
    }
}
