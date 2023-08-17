<?php

namespace App\Http\Livewire\client;

use Livewire\Component;
use App\Models\ClientType;

class ClientTypeForm extends Component
{
    public  $clientTypeId, $client_type;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'clientTypeID',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function clientTypeID($clientid)
    {
        $this->clientTypeId = $clientid;
        // dd($this->clientTypeId);
        $clientTypes = ClientType::find($clientid);
        $this->client_type = $clientTypes->client_type;
    }

    public function render()
    {
        return view('livewire.client.client-type-form');
    }

    public function store()
    {

        $action = '';

        $data = $this->validate([
            'client_type' => 'required',
        ]);
        if ($this->clientTypeId) {
            ClientType::find($this->clientTypeId)->update($data);
            $action = 'edit';
        } else {
            ClientType::create($data);
            $action = 'store';
        }
        $this->emit('showEmitedFlashMessage', $action);
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('refreshDataTable');
        $this->emit('closeClientTypeModal');
    }
}