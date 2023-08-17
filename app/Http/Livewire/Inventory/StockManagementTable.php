<?php

namespace App\Http\Livewire\Inventory;

use App\Models\ProcurementItems;
use App\Models\StockManagement;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class StockManagementTable extends Component
{
    use WithPagination;

    public $stockManagementId, $url;

    protected $listeners = [
        'refreshParentStockMngt' => '$refresh',
        'deleteStockManagement',
        'showEmitedFlashMessage',
        'showRepNotification'
    ];

    public function mount()
    {
        $this->url = Route::current()->getName();
    }

    public function showRepNotification($qty)
    {
        if ($qty < 5 && $qty > 0) {
            session()->flash('rep_notification', 'Item is almost out of stock.');
        } elseif ($qty <= 0) {
            session()->flash('rep_notification', 'Item is out of stock.');
        }
    }

    public function showEmitedFlashMessage($action)
    {
        if ($action == 'edit') {
            session()->flash('edit', 'Stock Updated Successfully.');
        } else {
            session()->flash('store', 'Stock Created Successfully.');
        }
    }

    public function createStockManagement()
    {
        $this->emit('resetInputFields');
        $this->emit('select2');
        $this->emit('openStockManagementModal');
        $this->emit('setUrl', $this->url);
    }

    public function editStockManagement($stockManagementId)
    {
        $this->stockManagementId = $stockManagementId;
        $this->emit('stockManagementId', $this->stockManagementId);
        $this->emit('openStockManagementModal');
    }

    public function deleteConfirmStockManagement($stockManagementId)
    {
        $this->dispatchBrowserEvent('swal:confirmStockManagementDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $stockManagementId
        ]);
    }

    public function deleteStockManagement($stockManagementId)
    {
        StockManagement::destroy($stockManagementId);

        $this->resetPage();
        return redirect()->to('/stock-management');
    }

    public function render()
    {
        // dd(StockManagement::with('suppliers')->get());
        return view('livewire.inventory.stock-management-table', [
            'stockManagement' => StockManagement::with('suppliers')->get(),
        ]);
    }
}