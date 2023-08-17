<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\EngineCategory;

class EngineCategoryForm extends Component
{
    public $slug, $enginecategoryID, $engine_category;
    public $action = '';
    public $message = '';

    protected $listeners = [
        'enginecategoryID',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function enginecategoryID($enginecategoryID){
        $this->enginecategoryID = $enginecategoryID;
        $enginecategory = EngineCategory::find($enginecategoryID);
        $this->engine_category = $enginecategory->engine_category;
    }

    public function render()
    {
        return view('livewire.engine.engine-category-form');
    }

    
    public function store(){

        $data = $this->validate([
            'engine_category' => 'required',
        ]);

        try
		{
            if($this->enginecategoryID){
                EngineCategory::find($this->enginecategoryID)->update($data);
            }else{
                EngineCategory::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->enginecategoryID){
            $action = 'edit';
            $message = 'Engine Category Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Engine Category Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeenginecategoryModal');
    } 
}
