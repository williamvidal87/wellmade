<?php

namespace App\Http\Livewire\Billing;

use App\Enums\ReceiptForTransaction;
use App\Enums\ServiceInvoice as EnumsServiceInvoice;
use App\Models\InvoiceTypes;
use App\Models\SbTransaction;
use App\Models\TransactionSummary;
use App\Models\WvTransaction;
use App\Service\IncentiveService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceInvoiceTable extends Component
{

    use WithPagination;

    public $serviceInvoiceId, $dateFrom, $dateTo;
    private $receipt_no;
    private IncentiveService $incentiveService;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteServiceInvoice',
    ];

    public function mount(IncentiveService $incentiveService)
    {
        $this->incentiveService = $incentiveService;
    }

    public function createServiceInvoice()
    {
        $this->emit('resetInputFields');
        $this->emit('openServiceInvoiceModal');
        $this->receipt_no =  $this->emit('serviceInvoiceDate', Carbon::today());
        $lastSbId = SbTransaction::latest('id')->first();
        $lastWvId = WvTransaction::latest('id')->first();
        $invoice_types = InvoiceTypes::all();
        $newNumber = [];
        if ($lastSbId == null && $lastWvId == null) {
            $invoice_no = '-' . str_pad(1, 5, '0', STR_PAD_LEFT);

            foreach ($invoice_types as $value) {
                if($value->invoice_type == "SB" || $value->invoice_type == "WV"){
                    $newNumber[$value->invoice_type.$invoice_no] = $value->invoice_type.$invoice_no;
                }
            }

        } elseif($lastSbId == null && $lastWvId != null){
            $sbInvoice_no = '-' . str_pad(1, 5, '0', STR_PAD_LEFT);
            $wvInvoice_no = '-' . str_pad(++$lastWvId->id, 5, '0', STR_PAD_LEFT);

            foreach ($invoice_types as $value) {
                if($value->invoice_type == "SB"){
                    $newNumber[$value->invoice_type.$sbInvoice_no] = $value->invoice_type.$sbInvoice_no;
                }else if($value->invoice_type == "WV"){
                    $newNumber[$value->invoice_type.$wvInvoice_no] = $value->invoice_type.$wvInvoice_no;
                }
            }

        } elseif($lastSbId != null && $lastWvId == null){
            $sbInvoice_no = '-' . str_pad(++$lastSbId->id, 5, '0', STR_PAD_LEFT);
            $wvInvoice_no = '-' . str_pad(1, 5, '0', STR_PAD_LEFT);

            foreach ($invoice_types as $value) {
                if($value->invoice_type == "SB"){
                    $newNumber[$value->invoice_type.$sbInvoice_no] = $value->invoice_type.$sbInvoice_no;
                }else if($value->invoice_type == "WV"){
                    $newNumber[$value->invoice_type.$wvInvoice_no] = $value->invoice_type.$wvInvoice_no;
                }
            }

        }else {
            $sbInvoice_no = '-' . str_pad(++$lastSbId->id, 5, '0', STR_PAD_LEFT);
            $wvInvoice_no = '-' . str_pad(++$lastWvId->id, 5, '0', STR_PAD_LEFT);

            foreach ($invoice_types as $value) {
                if($value->invoice_type == "SB"){
                    $newNumber[$value->invoice_type.$sbInvoice_no] = $value->invoice_type.$sbInvoice_no;
                }else if($value->invoice_type == "WV"){
                    $newNumber[$value->invoice_type.$wvInvoice_no] = $value->invoice_type.$wvInvoice_no;
                }
            }

        }

        $this->emit('serviceInvoiceNumber', $newNumber, ReceiptForTransaction::INVOICES);
    }

    public function showServiceInvoice($serviceInvoiceId)
    {
        $this->serviceInvoiceId = $serviceInvoiceId;
        $this->emit('serviceInvoiceId', $this->serviceInvoiceId);
        $this->emit('openServiceInvoiceViewModal');
    }


    public function editServiceInvoice($serviceInvoiceId)
    {
        $this->serviceInvoiceId = $serviceInvoiceId;
        $this->emit('serviceInvoiceId', $this->serviceInvoiceId);
        $this->emit('openServiceInvoiceModal');
    }

    public function render()
    {
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $serviceInvoice = TransactionSummary::with('jobOrder', 'transactionStatus', 'paymentStatus')->where(function ($query) use ($dateFrom, $dateTo) {
            if (!is_null($dateFrom) && !is_null($dateTo)) {
                $dateFrom = Carbon::parse($this->dateFrom);
                $dateTo = Carbon::parse($this->dateTo)->addHour(23)->addMinute(59)->addSecond(59);
                $query->where('created_at', '>=', $dateFrom)
                    ->where('created_at', '<=', $dateTo)
                    ->where('transaction_type_id', '=', EnumsServiceInvoice::SERVICE_INVOICE);
            } else {
                $query->where('transaction_type_id', '=', EnumsServiceInvoice::SERVICE_INVOICE);
            }
        })->get();

        return view('livewire.billing.service-invoice-table', [
            'serviceInvoice' => $serviceInvoice,
        ]);
    }
}
