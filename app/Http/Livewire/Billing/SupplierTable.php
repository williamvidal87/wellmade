<?php

namespace App\Http\Livewire\Billing;

use App\Enums\Status;
use App\Models\BillingSupplier;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierTable extends Component
{
    use WithPagination;

    public $supplierId, $url;

    protected $listeners = [
        'refreshParentCheckVoucher' => '$refresh',
        'inactiveStatusSupplier',
        'activeStatusSupplier',
    ];

    public function mount()
    {
        $this->url = Route::current()->getName();
    }

    public function createSupplier(){
        $this->emit('resetInputFields');
        $this->emit('openSupplier');
        $this->emit('setUrl', $this->url);
    }

    
    public function editSupplier($supplierId){
        $this->supplierId = $supplierId;
        $this->emit('supplierId',$this->supplierId);
        $this->emit('openSupplier');
    }

    public function inactiveStatusConfirmSupplier($supplierId){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:inactiveStatusConfirmSupplier', [
            'title' => 'Are you sure?',
            'text' => "Client status will be changed to inactive!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, update it!',
            'id' => $supplierId
        ]);
    }

    public function inactiveStatusSupplier($supplierId)
    {
        BillingSupplier::where('id', $supplierId)->update([
            'status_id' => Status::INACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/supplier');
    }

    public function activeStatusConfirmSupplier($supplierId){

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:activeStatusConfirmSupplier', [
            'title' => 'Are you sure?',
            'text' => "Client status will be changed to active!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, update it!',
            'id' => $supplierId
        ]);
    }

    public function activeStatusSupplier($supplierId)
    {
        BillingSupplier::where('id', $supplierId)->update([
            'status_id' => Status::ACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/supplier');
    }

    public function render()
    {
        return view('livewire.billing.supplier-table', [
            'suppliers' => BillingSupplier::with('getStatus')->get(),
        ]);
    }
}
