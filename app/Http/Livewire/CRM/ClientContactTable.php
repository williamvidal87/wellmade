<?php

namespace App\Http\Livewire\CRM;

use App\Enums\Status;
use App\Models\ClientProfile;
use Livewire\Component;
use Livewire\WithPagination;

class ClientContactTable extends Component
{
    use WithPagination;

    public $clientContactId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'toInActive',
        'toActive',
    ];

    public function createClientContact()
    {
        $this->emit('resetInputFields');
        $this->emit('openClientContactModal');
        $this->emit('select2');
    }

    public function editClientContact($clientContactId)
    {
        $this->emit('resetInputFields');
        $this->clientContactId = $clientContactId;
        $this->emit('clientContactId', $this->clientContactId);
        $this->emit('openClientContactModal');
    }

    public function paymentClientContact($clientContactId)
    {
        $this->emit('resetTransactionInputFields');
        // $this->clientContactId = $clientContactId;
        $this->emit('paymentClientContactId', $clientContactId);
        $this->emit('openPaymentClientContactModal');
    }

    public function transactionClientContact($clientContactId)
    {
        $this->emit('resetTransactionInputFields');
        // $this->clientContactId = $clientContactId;
        $this->emit('transactionClientContactId', $clientContactId);
        $this->emit('openTransactionClientContactModal');
    }

    public function changeToInactive($clientContactId)
    {
        $this->dispatchBrowserEvent('swal:confirmChangeToInactive', [
            'title' => 'Are you sure?',
            'text' => "Client status will be changed to inactive!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, change it!',
            'id' => $clientContactId
        ]);
    }

    public function toInActive($clientContactId)
    {
        ClientProfile::where('id' ,$clientContactId)->update([
            'status_id' => Status::INACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/client-contact');
    }

    public function changeToActive($clientContactId)
    {
        $this->dispatchBrowserEvent('swal:confirmChangeToActive', [
            'title' => 'Are you sure?',
            'text' => "Client status will be changed to active!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, change it!',
            'id' => $clientContactId
        ]);
    }

    public function toActive($clientContactId)
    {
        ClientProfile::where('id' ,$clientContactId)->update([
            'status_id' => Status::ACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/client-contact');
    }

    public function render()
    {
        return view('livewire.c-r-m.client-contact-table', [
            'clientContact' => ClientProfile::with('getStatus')->get(),
        ]);
    }
}
