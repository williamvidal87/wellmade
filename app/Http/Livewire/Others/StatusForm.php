<?php

namespace App\Http\Livewire\Others;

use Livewire\Component;
use App\Models\Status;

class StatusForm extends Component
{
    public  $Id, $status;

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
    public function Id($id){      
        $this->Id = $id;     
        $status = Status::find($id);
        $this->status = $status->status;
    }

    public function render()
    {
        return view('livewire.others.status-form');
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'status' => 'required',
        ]);
        try
		{
            if($this->Id){
                Status::find($this->Id)->update($data);
            }else{
                Status::create($data);
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
