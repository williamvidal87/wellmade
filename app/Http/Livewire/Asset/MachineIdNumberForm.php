<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineIdNumber;
use Livewire\Component;

class MachineIdNumberForm extends Component
{
    public $machine_id_number;
    public $machineNumberId;
    
    protected $listeners = [
        'editMachineNumberId',
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
        return view('livewire.asset.machine-id-number-form');
    }


    public function editMachineNumberId($id)
    {      
        $this->machineNumberId = $id;     

        $machineNumber = MachineIdNumber::find($id);
        $this->machine_id_number = $machineNumber->machine_id_number;
    }

    public function store()
    {
        $data = $this->validate([
            'machine_id_number' => 'required'
        ]);

        try {
            if($this->machineNumberId) {
                MachineIdNumber::find($this->machineNumberId)->update($data);
            }else{
                MachineIdNumber::create($data);
            }
           
        }catch(\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }
        if($this->machineNumberId){
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
        $this->emit('closeMachineNumberModal');       

    }   
}
