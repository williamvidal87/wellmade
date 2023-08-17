<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineDescription;
use App\Models\MachineIdNumber;
use Livewire\Component;

class MachineDescriptionForm extends Component
{
   
    public $machine_description_number_id, $description;
    public $MachineDescriptionId;
    
    protected $listeners = [
        'editMachineDescriptionId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.asset.machine-description-form', [
            'machine_number' => MachineIdNumber::all(),
            'check_machine_number_exist' => MachineDescription::select('machine_description_number_id')->get()
        ]);
    }


    public function editMachineDescriptionId($id)
    {      
        $this->MachineDescriptionId = $id;     

        $MachineDescription = MachineDescription::find($id);
        $this->machine_description_number_id = $MachineDescription->machine_description_number_id;
        $this->description = $MachineDescription->description;

    }

    public function store()
    {
        $data = $this->validate([
            'machine_description_number_id' => 'required',
            'description' => 'required',
        ]);
        
        $check_assign_number2=MachineDescription::Where('machine_description_number_id',$this->machine_description_number_id)->get()->first();
        if($check_assign_number2!=null){
            request()->validate([
                'machine_description_number_id' => 'required',
            ],
            [
                'machine_description_number_id.required' => 'This id number is already exist',
            ]);
        }

        try {
            if($this->MachineDescriptionId) {
                MachineDescription::find($this->MachineDescriptionId)->update($data);
            }else{
                MachineDescription::create($data);
            }
           
        }catch(\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }
        if($this->MachineDescriptionId){
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
        $this->emit('closeMachineDescriptionModal');       

    }   
}
