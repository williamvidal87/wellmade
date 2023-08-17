<?php

namespace App\Http\Livewire\JOMS;

use Livewire\Component;
use App\Models\JobTypes;
use Livewire\WithPagination;

class JOTypeTable extends Component
{
    use WithPagination;
    public $jobtypeID;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteJobType'
    ];

    public function createJobType()
    {
        $this->emit('resetInputFields');
        $this->emit('openJobTypeModal');
    }
    public function editJobType($job_typeID)
    {

        $this->jobtypeID = $job_typeID;
        $this->emit('jobtypeID', $this->jobtypeID);
        $this->emit('openJobTypeModal');
    }

    public function deleteConfirmJobTypeTable($job_typeID)
    {
        $this->dispatchBrowserEvent('swal:confirmJobTypeTableDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $job_typeID
        ]);
    }

    public function render()
    {
        return view('livewire.j-o-m-s.j-o-type-table', [
            'job_Types' => JobTypes::all()->sortBy('id')
        ]);
    }

    public function deleteJobType($jobtypeID)
    {
        // dd($clientTypeId);
        JobTypes::destroy($jobtypeID);
        $this->reset();
    }
}