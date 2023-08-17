<?php

namespace App\Http\Livewire\Inventory;

use App\Models\ProcurementItems;
use App\Models\PurchaseOrder;
use App\Models\StockManagement;
use Livewire\Component;

class PurchaseHistoryForm extends Component
{

    public $procurementManagementId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'procurementManagementId',
    ];

    //edit
    public function procurementManagementId($procurementManagementId)
    {
        $this->procurementManagementId = $procurementManagementId;
    }

    // disable options
    public function selectChange($value){
        $this->emit('disableOption');
    }

    public function render()
    {
        $report_data = PurchaseOrder::where('id', $this->procurementManagementId)->with('suppliers')->get();  
        $items = ProcurementItems::where('pr_id', $this->procurementManagementId)->orderBy('product_arrangement')->with('stockManagement')->get();
        
        return view('livewire.inventory.purchase-history-form',[
            'report_data' => $report_data,
            'items' => $items,
        ]);
    }
}
