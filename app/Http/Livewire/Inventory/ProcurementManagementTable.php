<?php

namespace App\Http\Livewire\Inventory;

use App\Enums\Status;
use App\Models\PurchaseOrder;
use App\Models\StockManagement;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ProcurementManagementTable extends Component
{

    use WithPagination;

    public $procurementManagementId;
    protected $pr_no;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteProcurementManagement',
        'approveProcurement'
    ];

    public function createProcurementManagement()
    {
        $this->emit('resetInputFields');
        $this->emit('select2');
        $this->emit('openProcurementManagementModal');
        $lastId = PurchaseOrder::withTrashed()->latest('id')->first();
        if($lastId == null){
            $newNumber = date('Y'). '-'. str_pad(1, 5, '0', STR_PAD_LEFT);
        }else{
            $newNumber = date('Y'). '-'. str_pad(++$lastId->id, 5, '0', STR_PAD_LEFT);
        }
        
        $this->pr_no = $this->emit('procurementNumber', $newNumber, Carbon::today());
    }

    public function editProcurementManagement($procurementManagementId)
    {
        $this->procurementManagementId = $procurementManagementId;
        $this->emit('procurementManagementId', $this->procurementManagementId);
        $this->emit('openProcurementManagementModal');
        $this->emit('disableOption');   
    }

    public function viewProcurementManagement($procurementManagementId)
    {
        $this->emit('resetInputFields');
        $this->procurementManagementId = $procurementManagementId;
        $this->emit('viewProcurementManagement', $this->procurementManagementId);
        $this->emit('openProcurementManagementModal');
    }

    public function deleteConfirmProcurementManagement($procurementManagementId)
    {
        $this->dispatchBrowserEvent('swal:confirmProcurementManagementDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, cancel it!',
            'id' => $procurementManagementId
        ]);
    }

    public function deleteProcurementManagement($procurementManagementId)
    {
        PurchaseOrder::where('id', $procurementManagementId)->update([
            'status_id' => Status::CANCELLED
        ]);

        // Deduct the procurement items qty into the stock qty
        $purchase_order = PurchaseOrder::with('getProcurementItems.stockManagement')->where('id',$procurementManagementId)->first();

        foreach ($purchase_order->getProcurementItems as $key => $value) {
            foreach ($value->stockManagement as $key => $data) {
                if($data->qty - $value->qty <= 10 && $data->qty - $value->qty > 0){
                    StockManagement::where('id', $value->stock_id)->update([
                        'qty' => $data->qty - $value->qty,
                        'REP' => 1 // less than 10 qty and greater than 0
                    ]);
                } elseif ($data->qty - $value->qty <= 0) {
                    StockManagement::where('id', $value->stock_id)->update([
                        'qty' => $data->qty - $value->qty,
                        'REP' => 2 // less than or equal to 0 qty
                    ]);
                }else{
                    StockManagement::where('id', $value->stock_id)->update([
                        'qty' => $data->qty - $value->qty,
                        'REP' => 0 // greater than or equal to 11
                    ]);
                }
            }
        }

        $this->resetPage();
        return redirect()->to('/procurement-management');
    }

    public function render()
    {
        return view('livewire.inventory.procurement-management-table', [
            'procurementManagements' => PurchaseOrder::with('statuses')->get(), 
        ]);
    }


    public function approveConfirmProcurementManagement($procurementManagementId)
    {
        $this->dispatchBrowserEvent('swal:confirmProcurementManagement', [
            'title' => 'Are you sure to approved?',
            'text' => "You won't be able to revert this!",
            'icon' => 'info',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, approve it!',
            'id' => $procurementManagementId
        ]);
    }
    
    public function approveProcurement($procurementManagementId){
        PurchaseOrder::whereid($procurementManagementId)->update([
            'status_id' => Status::APPROVED
        ]);

        // Add the procurement items qty into the stock qty
        $purchase_order = PurchaseOrder::with('getProcurementItems.stockManagement')->where('id',$procurementManagementId)->first();

        foreach ($purchase_order->getProcurementItems as $key => $value) {
            foreach ($value->stockManagement as $key => $data) {
                if($data->qty + $value->qty <= 10 && $data->qty + $value->qty > 0){
                    StockManagement::where('id', $value->stock_id)->update([
                        'qty' => $data->qty + $value->qty,
                        'REP' => 1 // less than 10 qty and greater than 0
                    ]);
                } elseif ($data->qty + $value->qty <= 0) {
                    StockManagement::where('id', $value->stock_id)->update([
                        'qty' => $data->qty + $value->qty,
                        'REP' => 2 // less than or equal to 0 qty
                    ]);
                }else{
                    StockManagement::where('id', $value->stock_id)->update([
                        'qty' => $data->qty + $value->qty,
                        'REP' => 0 // greater than or equal to 11
                    ]);
                }
            }
        }

        return redirect()->to('/procurement-management');
    }
}
