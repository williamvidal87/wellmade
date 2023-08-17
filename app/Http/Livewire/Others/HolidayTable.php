<?php

namespace App\Http\Livewire\Others;

use App\Models\Holiday;
use Livewire\Component;
use Livewire\WithPagination;

class HolidayTable extends Component
{
    use WithPagination;

    public $holidayId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete',
    ];

    public function create()
    {
        $this->emit('resetInputFields');
        $this->emit('openModal');
    }

    public function edit($id){        
        $this->holidayId = $id;
        $this->emit('holidayEdit',$this->holidayId);
        $this->emit('openModal');
    }

    public function deleteConfirm($id){
        $this->dispatchBrowserEvent('swal:confirmDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $id
        ]);
    }

    public function delete($id){

        Holiday::destroy($id);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.others.holiday-table', [
            'holidays' => Holiday::all(),
        ]);
    }
}
