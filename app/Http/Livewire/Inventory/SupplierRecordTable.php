<?php

namespace App\Http\Livewire\Inventory;

use App\Enums\Status;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierRecordTable extends Component
{
    use WithPagination;

    public $supplierRecordId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'toInActive',
        'toActive',
        'showEmitedFlashMessage',
    ];

    public function showEmitedFlashMessage($action)
    {
        if ($action == 'edit') {
            session()->flash('edit', 'Supplier Updated Successfully.');
        } else {
            session()->flash('store', 'Supplier Created Successfully.');
        }
    }

    public function createSupplierRecord()
    {
        $this->emit('resetInputFields');
        $this->emit('openSupplierRecordModal');
    }

    public function editSupplierRecord($supplierRecordId)
    {
        $this->emit('resetInputFields');
        $this->supplierRecordId = $supplierRecordId;
        $this->emit('supplierRecordId', $this->supplierRecordId);
        $this->emit('openSupplierRecordModal');
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
        Supplier::where('id' ,$clientContactId)->update([
            'status_id' => Status::INACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/supplier-record');
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
        Supplier::where('id' ,$clientContactId)->update([
            'status_id' => Status::ACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/supplier-record');
    }

    public function render()
    {
        return view('livewire.inventory.supplier-record-table', [
            'supplierRecord' => Supplier::with('getStatus')->get(),
        ]);
    }
}
