<?php

namespace App\Http\Livewire\client;

use App\Models\CsaType;
use Livewire\Component;
use Livewire\WithPagination;

class CsaTypeTable extends Component
{

    use WithPagination;

    public $csaTypeId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteCsaType'
    ];


    public function showEmitedFlashMessage($action)
    {
        // dd($action);

        $this->action = $action;
        $this->emit('flashAction', $this->action);
    }

    public function createCsaType()
    {
        $this->emit('resetInputFields');
        $this->emit('openCsaTypeModal');
    }


    public function editCsaType($csaTypeId)
    {
        $this->csaTypeId = $csaTypeId;
        $this->emit('csaTypeId', $this->csaTypeId);
        $this->emit('openCsaTypeModal');
    }

    public function deleteConfirmCsaType($csaTypeId)
    {
        // dd($clientTypeId);
        // $this->dispatchBrow  serEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmCsaTypeDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $csaTypeId
        ]);
    }

    public function deleteCsaType($csaTypeId)
    {
        // dd($clientTypeId);
        CsaType::destroy($csaTypeId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.client.csa-type-table', [
            'csaTypes' => CsaType::all()
        ]);
    }
}
