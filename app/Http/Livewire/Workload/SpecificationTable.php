<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\Specifications;
use Livewire\WithPagination;

class SpecificationTable extends Component
{
    public $specificationID;
    use WithPagination;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteSpecificationList'
    ];

    public function createSpecificationList()
    {
        $this->emit('resetInputFields');
        $this->emit('openSpecificationListModal');
    }
    public function editSpecificationList($specificationID)
    {

        $this->specificationID = $specificationID;
        $this->emit('specificationID', $this->specificationID);
        $this->emit('openSpecificationListModal');
    }

    public function deleteConfirmSpecificationList($specificationID)
    {
        $this->dispatchBrowserEvent('swal:confirmSpecificationListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $specificationID
        ]);
    }
    public function render()
    {
        return view('livewire.workload.specification-table', [
            'specifications' => Specifications::all()->sortBy('id')
        ]);
    }
    public function deleteSpecificationList($specificationID)
    {   $action = 'delete';
        $message = ' ';
        // dd($action);
        $this->emit('flashAction',$action,$message);
        Specifications::destroy($specificationID);
        $this->reset();
    }
}