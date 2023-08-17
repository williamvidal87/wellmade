<?php

namespace App\Http\Livewire\Machine;

use Livewire\Component;
use App\Models\Calibrations;

class CalibrationForm extends Component
{
    public $calibrationID, $callib_name, $message, $action;

    protected $listeners = [
        'calibrationlistID',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function calibrationlistID($calibrationLISTID)
    {
        $this->calibrationID = $calibrationLISTID;
        $machineList = Calibrations::find($calibrationLISTID);
        $this->callib_name = $machineList->callib_name;
    }
    public function render()
    {
        return view('livewire.machine.calibration-form');
    }

    public function tablemodal()
    {
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeMachineandFabricationListModal');
    }

    public function store()
    {
        $data = $this->validate([
            'callib_name' => 'required',
        ]);

        try {
            if ($this->calibrationID) {
                Calibrations::find($this->calibrationID)->update($data);
            } else {
                Calibrations::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->calibrationID) {
            $action = 'edit';
            $message = 'Calibration Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Calibration Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeCalibrationListModal');
    }
}