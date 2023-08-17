<?php

namespace App\Http\Livewire\Inventory;

use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Livewire\Component;

class PurchaseHistoryTable extends Component
{

    public $procurementManagementId, $dateFrom, $dateTo;

    public function editProcurementManagement($procurementManagementId)
    {
        $this->procurementManagementId = $procurementManagementId;
        $this->emit('procurementManagementId', $this->procurementManagementId);
        $this->emit('openProcurementManagementModal');
        $this->emit('disableOption');   
    }

    public function render()
    {
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $procurementManagement = PurchaseOrder::with('users', 'suppliers')->where(function ($query) use ($dateFrom, $dateTo) {
            if (!is_null($dateFrom) && !is_null($dateTo)) {
                $dateFrom = Carbon::parse($this->dateFrom);
                $dateTo = Carbon::parse($this->dateTo)->addHour(23)->addMinute(59)->addSecond(59);
                $query->where('created_at', '>=', $dateFrom)
                    ->where('created_at', '<=', $dateTo)
                    ->where('status_id', '=', 2);
            } else {
                $query->where('status_id', '=', 2);
            }
        })->get();

        return view('livewire.inventory.purchase-history-table', [
            'procurementManagement' => $procurementManagement,
        ]);
    }
}
