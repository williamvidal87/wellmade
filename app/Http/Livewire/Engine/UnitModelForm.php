<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\UnitModel;

class UnitModelForm extends Component
{
    public  $Id, $unit;
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
        $engine = UnitModel::find($Id);
        $this->unit = $engine->unit;
    }
    
    public function render()
    {
        return view('livewire.engine.unit-model-form');
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'unit' => 'required',
        ]);
        try
		{
            if($this->Id){
                UnitModel::find($this->Id)->update($data);
            }else{
                UnitModel::create($data);
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
