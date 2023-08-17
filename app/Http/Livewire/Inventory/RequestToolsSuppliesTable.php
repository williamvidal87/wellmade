<?php

namespace App\Http\Livewire\Inventory;

use App\Enums\Status;
use App\Models\RequestPart;
use App\Models\RequestTool;
use App\Models\StockManagement;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use Livewire\WithPagination;

class RequestToolsSuppliesTable extends Component
{

    use WithPagination;

    public $requestToolsSuppliesId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteRequestTools',
        'confirmApproveRequestTools',
    ];

    public function createRequestToolsSupplies()
    {
        $this->emit('resetInputFields');
        $this->emit('openRequestToolsSuppliesModal');
        $this->emit('select2');
        $this->emit('requestToolsSuppliesDate', Carbon::today());
    }

    public function editRequestTools($requestToolsSuppliesId)
    {
        $this->emit('resetInputFields');
        $this->requestToolsSuppliesId = $requestToolsSuppliesId;
        $this->emit('requestToolsId', $this->requestToolsSuppliesId);
        $this->emit('select2');
        $this->emit('openRequestToolsSuppliesModal');
    }

    public function deleteConfirmRequestTools($requestToolsSuppliesId)
    {
        $this->dispatchBrowserEvent('swal:confirmRequestToolsDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, cancel it!',
            'id' => $requestToolsSuppliesId
        ]);
    }

    public function deleteRequestTools($requestToolsSuppliesId)
    {
        // RequestTool::destroy($requestToolsSuppliesId);

        // Return back the number of stock been deducted
        $request_tool = RequestTool::with('requestToolsData.getStockManagment')->where('id',$requestToolsSuppliesId)->first();
        if($request_tool->status_id == 2){
            foreach ($request_tool as $key => $value) {
                foreach ($request_tool->requestToolsData as $key => $data) {
                    if($data->getStockManagment->qty + $data->qty <= 10 && $data->getStockManagment->qty + $data->qty > 0){
                        StockManagement::where('id', $data->item_id)->update([
                            'qty' => $data->getStockManagment->qty + $data->qty,
                            'REP' => 1 // less than 10 qty and greater than 0
                        ]);
                    } elseif ($data->getStockManagment->qty + $data->qty <= 0) {
                        StockManagement::where('id', $data->item_id)->update([
                            'qty' => $data->getStockManagment->qty + $data->qty,
                            'REP' => 2 // less than or equal to 0 qty
                        ]);
                    }else{
                        StockManagement::where('id', $data->item_id)->update([
                            'qty' => $data->getStockManagment->qty + $data->qty,
                            'REP' => 0 // greater than or equal to 11
                        ]);
                    }
                }
            }
        }
        // Update the status into cancelled
        RequestTool::where('id', $requestToolsSuppliesId)->update([
            'status_id' => 3,
        ]);

        // Remove in the request parts
        $request = RequestPart::find($requestToolsSuppliesId);
        if($request != null){
            $request->delete();
        }

        $this->resetPage();
        return redirect()->to('/request-tools-supplies');
    }

    public function approveRequestTools($requestToolsSuppliesId)
    {
        $this->dispatchBrowserEvent('swal:approveProcurementManagement', [
            'title' => 'Are you sure to approved?',
            'text' => "You won't be able to revert this!",
            'icon' => 'info',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, approve it!',
            'id' => $requestToolsSuppliesId
        ]);
    }

    public function confirmApproveRequestTools($requestToolsSuppliesId)
    {
        RequestTool::where('id', $requestToolsSuppliesId)->update([
            'status_id' => Status::APPROVED,
        ]);

        // Minus here the stocks
        $request_tool = RequestTool::with('requestToolsData.getStockManagment')->where('id',$requestToolsSuppliesId)->first();

        foreach ($request_tool as $key => $value) {
            foreach ($request_tool->requestToolsData as $key => $data) {
                if($data->getStockManagment->qty - $data->qty <= 10 && $data->getStockManagment->qty - $data->qty > 0){
                    StockManagement::where('id', $data->item_id)->update([
                        'qty' => $data->getStockManagment->qty - $data->qty,
                        'REP' => 1 // less than 10 qty and greater than 0
                    ]);
                } elseif ($data->getStockManagment->qty - $data->qty <= 0) {
                    StockManagement::where('id', $data->item_id)->update([
                        'qty' => $data->getStockManagment->qty - $data->qty,
                        'REP' => 2 // less than or equal to 0 qty
                    ]);
                }else{
                    StockManagement::where('id', $data->item_id)->update([
                        'qty' => $data->getStockManagment->qty - $data->qty,
                        'REP' => 0 // greater than or equal to 11
                    ]);
                }

            }
        }

        // Add in the request parts table
        RequestPart::create([
            'request_tools_id' => $requestToolsSuppliesId,
            'jo_no_id' => $request_tool->jo_no_id,
        ]);


        $this->resetPage();
        return redirect()->to('/request-tools-supplies');
    }

    public function viewRequestTools($requestToolsSuppliesId)
    {
        $this->emit('resetInputFields');
        $this->requestToolsSuppliesId = $requestToolsSuppliesId;
        $this->emit('viewRequestToolsId', $this->requestToolsSuppliesId);
        $this->emit('openRequestToolsSuppliesModal');
    }

    public function render()
    {
        return view('livewire.inventory.request-tools-supplies-table', [
            'request_tools' => RequestTool::with('getRequestBy', 'requestToolsData.getStockManagment', 'getJobOrder')->get(),
        ]);
    }
}
