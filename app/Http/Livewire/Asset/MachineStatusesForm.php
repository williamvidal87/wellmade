<?php

namespace App\Http\Livewire\Asset;

use App\Models\MachineStatus;
use Livewire\Component;

class MachineStatusesForm extends Component
{
    public $machine_status;
    public $machineStatusesID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'machineStatusesID',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function machineStatusesID($machineStatusesID){

        $this->machineStatusesID = $machineStatusesID;
        $machine_status = MachineStatus::find($machineStatusesID);
        $this->machine_status = $machine_status->machine_status;
    
    }

    public function save(){

        $data = $this->validate([
            'machine_status' => 'required'
        ]);
        
        try{

            if($this->machineStatusesID){

                MachineStatus::find($this->machineStatusesID)->update($data);

            }else{

                MachineStatus::create($data);

            }
        } catch (\Exception $e){
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->machineStatusesID){
            $action = 'edit';
            $message = 'Machine Status Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Machine Status Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closemachinestatusesmodal');
    }

    public function render()
    {
        return view('livewire.asset.machine-statuses-form');
    }
}
