<?php

namespace App\Http\Livewire\Billing;

use App\Models\ServiceBilling;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceBillingTable extends Component
{

    use WithPagination;

    public $serviceBillingId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteServiceBilling',
    ];

    public function createServiceBilling()
    {
        $this->emit('resetInputFields');
        $this->emit('openServiceBillingModal');
    }


    public function editServiceBilling($serviceBillingId)
    {
        $this->serviceBillingId = $serviceBillingId;
        $this->emit('serviceBillingId', $this->serviceBillingId);
        $this->emit('openServiceBillingModal');
    }

    public function deleteConfirmServiceBilling($serviceBillingId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmServiceBillingDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $serviceBillingId
        ]);
    }

    public function deleteServiceBilling($serviceBillingId)
    {

        ServiceBilling::destroy($serviceBillingId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.billing.service-billing-table', [
            'serviceBilling' => ServiceBilling::all(),
        ]);
    }
}
