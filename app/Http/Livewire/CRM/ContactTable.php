<?php

namespace App\Http\Livewire\CRM;

use App\Enums\Status;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class ContactTable extends Component
{
    use WithPagination;

    public $contactPersonId, $url;

    public function mount()
    {
        $this->url = Route::current()->getName();
    }

    protected $listeners = [
        'refreshParentContact' => '$refresh',
        'toInActive',
        'toActive',
    ];

    public function createContactPerson()
    {
        $this->emit('resetInputFields');
        $this->emit('openContactModal');
        $this->emit('setUrl', $this->url);
    }

    public function editContactPerson($contactPersonId)
    {
        $this->emit('resetInputFields');
        $this->contactPersonId = $contactPersonId;
        $this->emit('ContactId', $this->contactPersonId);
        $this->emit('openContactModal');
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
        Contact::where('id' ,$clientContactId)->update([
            'status_id' => Status::INACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/contact-person');
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
        Contact::where('id' ,$clientContactId)->update([
            'status_id' => Status::ACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/contact-person');
    }

    public function render()
    {
        return view('livewire.c-r-m.contact-table', [
            'contactPerson' => Contact::with('getStatus')->get(),
        ]);
    }
}
