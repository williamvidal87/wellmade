<?php

namespace App\Http\Livewire\client;

use Livewire\Component;
use App\Models\ClientType;
use Livewire\WithPagination;


class ClientTypeTable extends Component
{
    use WithPagination;

    public $clientTypeid;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteClientType'
    ];


    public function showEmitedFlashMessage($action)
    {
        // dd($action);

        $this->action = $action;
        $this->emit('flashAction', $this->action);
    }

    public function render()
    {
        // $this->authorize('crm_access');
        return view('livewire.client.client-type-table', [
            'clientTypes' => ClientType::all()
        ]);
    }

    public function createClientType()
    {
        $this->emit('resetInputFields');
        $this->emit('openClientTypeModal');
    }


    public function editClientType($clientId)
    {
        $this->clientTypeid = $clientId;
        $this->emit('clientTypeID', $this->clientTypeid);
        $this->emit('openClientTypeModal');
    }

    public function deleteConfirmClientType($clientTypeId)
    {
        // dd($clientTypeId);
        // $this->dispatchBrow  serEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmClientDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $clientTypeId
        ]);
    }

    public function deleteClientType($clientTypeId)
    {
        // dd($clientTypeId);
        ClientType::destroy($clientTypeId);
        $this->resetPage();
    }
}