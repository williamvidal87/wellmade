<?php

namespace App\Http\Livewire\Billing;

use App\Models\JoAcknowledgementReceipt;
use App\Models\JobOrder;
use App\Models\RequestPart;
use App\Models\Status;
use App\Models\TransactionSummary;
use Livewire\Component;
use Livewire\WithPagination;

class JoAcknowledgementReceiptTable extends Component
{

    use WithPagination;

    public $joAcknowledgementReceiptId, $status_filter;
    public $job_orders = [];
    public $listInvoices = [];
    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteJoAcknowledgementReceipt',
    ];

    public function createJoAcknowledgementReceipt()
    {
        $this->emit('resetInputFields');
        $this->emit('openJoAcknowledgementReceiptModal');
    }

    public function mount()
    {
        $this->job_orders = JobOrder::with('clientProfile', 'engineModel', 'getStatus', 'WorkOrders')->whereIn('status', [1,2,3,4,9])->get();
        $this->listInvoices = TransactionSummary::where('transaction_type_id', 2)->whereIn('transaction_status_id', [1,2])->whereIn('status_id', [12,13])->pluck('jo_no');
    }

    public function updatedStatusFilter($id)
    {

        if($this->status_filter == 1){
            $this->job_orders = JobOrder::with('clientProfile', 'engineModel', 'getStatus')->where('status', $this->status_filter)->get();
        }elseif ($this->status_filter == 2){
            $this->job_orders = JobOrder::with('clientProfile', 'engineModel', 'getStatus')->where('status', $this->status_filter)->get();
        }elseif ($this->status_filter == 3){
            $this->job_orders = JobOrder::with('clientProfile', 'engineModel', 'getStatus')->where('status', $this->status_filter)->get();
        }elseif ($this->status_filter == 4){
            $this->job_orders = JobOrder::with('clientProfile', 'engineModel', 'getStatus')->where('status', $this->status_filter)->get();
        }elseif ($this->status_filter == 9){
            $this->job_orders = JobOrder::with('clientProfile', 'engineModel', 'getStatus')->where('status', $this->status_filter)->get();
        }
    }


    public function editJoAcknowledgementReceipt($joAcknowledgementReceiptId)
    {
        $this->joAcknowledgementReceiptId = $joAcknowledgementReceiptId;
        $this->emit('editjoAcknowledgementReceiptId', $this->joAcknowledgementReceiptId);
        $this->emit('openJoAcknowledgementReceiptModal');
    }

    public function addJoAcknowledgementReceipt($joAcknowledgementReceiptId)
    {
        $this->joAcknowledgementReceiptId = $joAcknowledgementReceiptId;
        $this->emit('joAcknowledgementReceiptId', $this->joAcknowledgementReceiptId);
        $this->emit('openJoAcknowledgementReceiptModal');
    }

    public function invoicesJoAcknowledgementReceipt($joAcknowledgementReceiptId)
    {
        $this->emit('resetInputFields');
        // $this->clientContactId = $clientContactId;
        $this->emit('joAcknowledgementReceiptInvoicesId', $joAcknowledgementReceiptId);
        $this->emit('openJoAcknowledgementReceiptInvoicesModal');
    }

    public function deleteConfirmJoAcknowledgementReceipt($joAcknowledgementReceiptId)
    {
        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmJoAcknowledgementReceiptDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $joAcknowledgementReceiptId
        ]);
    }

    public function checkContainsPart($id)
    {
        $overall_part_total = 0;
        // Get the parts
        $request_part = RequestPart::with('getRequestTool.requestToolsData.getStockManagment')->where('jo_no_id', $id)->first();

        if(!empty($request_part)){
            foreach ($request_part->getRequestTool->requestToolsData as $value){
                $overall_part_total += $value->qty * $value->getStockManagment->unit_price;
            }
        }

        return $overall_part_total;
    }

    public function render()
    {
        return view('livewire.billing.jo-acknowledgement-receipt-table', [
            'job_orders' => $this->job_orders,
            'status_filter_id'=> Status::whereIn('id',[1,2,3,4,9])->get(),
        ]);
    }
}
