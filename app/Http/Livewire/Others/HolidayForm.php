<?php

namespace App\Http\Livewire\Others;

use App\Models\Holiday;
use Illuminate\Validation\Rule;
use Livewire\Component;

class HolidayForm extends Component
{

    public $date, $name, $holidayId;

    protected $listeners = [
        'holidayEdit',
        'resetInputFields'
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function holidayEdit($id){      
        $this->holidayId = $id;     
        $holiday = Holiday::find($id);
        $this->date = $holiday->date;
        $this->name = $holiday->name;
    }

    public function store(){

        $action = '';

        $data = $this->validate([
            'date' => 'required|unique:holidays,date,NULL,id,deleted_at,NULL',
            'name' => 'required',
        ]);

        try{
            if($this->holidayId){
                Holiday::find($this->holidayId)->update($data);
            }else{
                Holiday::create($data);
            }

		} catch (\Exception $e) {
			// dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->holidayId){
            $action = 'edit';
            $message = 'Holiday Successfully Updated';
            $this->emit('flashAction',$action,$message);
        }else{
            $action = 'store';
            $message = 'Holiday Successfully Saved';
            $this->emit('flashAction',$action,$message);
            
        }
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeModal');
    }

    public function render()
    {
        return view('livewire.others.holiday-form');
    }
}
