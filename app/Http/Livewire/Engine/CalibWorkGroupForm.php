<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\CalibWorkGroup;

class CalibWorkGroupForm extends Component
{
    public  $Id, $calib_work_group_name;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'Id',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function Id($Id){      
        $this->Id = $Id;     
        $engine = CalibWorkGroup::find($Id);
        $this->calib_work_group_name = $engine->calib_work_group_name;
    }

    public function render()
    {
        return view('livewire.engine.calib-work-group-form');
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'calib_work_group_name' => 'required',
        ]);
        try
		{
            if($this->Id){
                CalibWorkGroup::find($this->Id)->update($data);
            }else{
                CalibWorkGroup::create($data);
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
