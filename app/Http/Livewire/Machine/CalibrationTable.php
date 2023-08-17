<?php

namespace App\Http\Livewire\Machine;

use Livewire\Component;
use App\Models\Calibrations;
use Livewire\WithPagination;

class CalibrationTable extends Component
{

    public $calibrationLISTId;
    use WithPagination;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteCalibrationList'
    ];

    public function createCalibrationList()
    {
        $this->emit('resetInputFields');
        $this->emit('openCalibrationListModal');
    }
    public function editCalibrationList($calibrationListID)
    {

        $this->calibrationLISTId = $calibrationListID;
        $this->emit('calibrationlistID', $this->calibrationLISTId);
        $this->emit('openCalibrationListModal');
    }

    public function deleteConfirmCalibrationList($calibrationID)
    {
        $this->dispatchBrowserEvent('swal:confirmCalibrationListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $calibrationID
        ]);
    }

    public function render()
    {
        return view('livewire.machine.calibration-table', [
            'calibrationList' => Calibrations::all()->sortBy('id')
        ]);
    }

    public function deleteCalibrationList($calibrationId)
    {
        // dd($clientTypeId);
        Calibrations::destroy($calibrationId);
        $this->reset();
    }
}