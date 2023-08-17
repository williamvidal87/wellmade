<?php

namespace App\Http\Livewire\Workload;

use Livewire\Component;
use App\Models\SubType;
use Livewire\WithPagination;

class SubTypeTable extends Component
{
    use WithPagination;

    public $subtypeId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deletesubtype',
    ];

    public function render()
    {
        return view('livewire.workload.sub-type-table', [
            'sub_types' => SubType::all()
        ]);
    }

    public function createSubtype()
    {
        $this->emit('resetInputFields');
        $this->emit('opensubtypeModal');
    }


    public function editSubtype($subtypeId)
    {
        $this->subtypeId = $subtypeId;
        $this->emit('subtypeId', $this->subtypeId);
        $this->emit('opensubtypeModal');
    }

    public function deleteConfirmSubtype($subtypeId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmsubtypeDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $subtypeId
        ]);
    }

    public function deletesubtype($id){
        $action = 'delete';
            $message = ' ';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        SubType::destroy($id);
        $this->resetPage();
    }
}
