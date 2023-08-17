<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\UnitModelList;
use App\Models\UnitModel;


class UnitModelListForm extends Component
{
    public  $Id, $unit_id, $engine;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'Id',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
    }

    //edit
    public function Id($Id){      
        $this->Id = $Id;     
        $engine = UnitModelList::find($Id);
        $this->unit_id = $engine->unit_id;
        $this->engine = $engine->engine;
    }

    public function render()
    {
        return view('livewire.engine.unit-model-list-form',[
            'engines' => UnitModel::all()
        ]);
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'unit_id' => 'required',
            'engine'  => 'required'

        ]);
        try
		{
            if($this->Id){
                UnitModelList::find($this->Id)->update($data);
            }else{
                UnitModelList::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->Id){
            $action = 'edit';
            $message = 'Record Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Record Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeModal');

    }
}
