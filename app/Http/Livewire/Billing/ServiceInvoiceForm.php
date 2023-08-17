<?php

namespace App\Http\Livewire\Billing;

use App\Enums\ForTransaction;
use App\Enums\InvoiceTypes as EnumsInvoiceTypes;
use App\Enums\ServiceInvoice as EnumsServiceInvoice;
use App\Enums\Status;
use App\Enums\TransactionStatus;
use App\Models\ChartOfAccounts;
use App\Models\InvoiceTypes;
use App\Models\JobOrder;
use App\Models\ReceiptFor;
use App\Models\Remark;
use App\Models\SbTransaction;
use App\Models\TransactionData;
use App\Models\TransactionFor;
use App\Models\TransactionParticular;
use App\Models\TransactionSummary;
use App\Models\WvTransaction;
use App\Service\IncentiveService;
use App\Service\TransactionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ServiceInvoiceForm extends Component
{

    public $date, $receipt_for, $for, $jo_no, $customer_name, $sb_date, $serviceInvoiceId, $accnt_no, $account_title, $debits, $credits, $all_total_debits, $all_total_credits;
    public $listItems = [];
    public $oldItems = [];
    public $action = '';
    public $message = '';
    public $receipt_no = '';
    public $invoice_no = [];
    private $transactionService, $incentiveService;
    public $transaction_status, $toBeDisableSb, $toBeDisableWv, $remark_id, $invoice_type_id, $wv_invoice_no, $wv_date, $sb_invoice_no, $time;
    public $listInvoices = [];
    public $temp_wv_invoice_no, $temp_wv_date, $temp_sb_invoice_no, $temp_sb_date, $post_jo_no, $old_invoice_type_id, $transaction_status_id;
    public $isWvSb = false;

    protected $listeners = [
        'refreshParentServiceInvoice' => '$refresh',
        'serviceInvoiceId',
        'resetInputFields',
        'serviceInvoiceDate',
        'serviceInvoiceNumber',
        'jobOrderNumber',
        'cancelServiceInvoice',
        'postServiceInvoice',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->addItem();
    }

    public function mount()
    {
        $this->addItem();
    }

    public function cancelConfirmServiceInvoice($serviceInvoiceId)
    {
        $this->dispatchBrowserEvent('swal:cancelConfirmServiceInvoiceTransaction', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, cancel it!',
            'id' => $serviceInvoiceId,
        ]);
    }

    public function cancelServiceInvoice($serviceInvoiceId, TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $transaction = TransactionSummary::with('jobOrder')->find($serviceInvoiceId);
        $transaction->update([
            'transaction_status_id' => TransactionStatus::REVERSED,
            'status_id' => Status::CANCELLED,
            // Remove the WV and SB
            'wv_invoice_no' => "",
            'sb_invoice_no' => "",
        ]);

        // Update the jo to unpaid
        $transaction->jobOrder->update([
            'payment_status_id' => Status::UNPAID,
        ]);

        // Update the receipts payments to setup
        $trans = TransactionParticular::where('transaction_summary_invoice_id', $serviceInvoiceId)->get();

        foreach ($trans as $key => $value) {
            TransactionSummary::where('id', $value->transaction_summary_receipt_id)->update([
                'transaction_status_id' => TransactionStatus::SETUP,
                'status_id' => Status::UNPAID,
            ]);
        }
        $this->transactionService->transactionParticulars($this->serviceInvoiceId);

        $this->emit('refreshParent');
        $this->emit('closeServiceInvoiceModal');
        return redirect()->to('/service-invoice');
    }

    public function updatedWvInvoiceNo()
    {
        if($this->wv_invoice_no != null){
            $this->wv_invoice_no = ltrim($this->wv_invoice_no, 'WV-');
            $this->wv_invoice_no = ltrim($this->wv_invoice_no, '0');
            $this->wv_invoice_no = 'WV-'. str_pad($this->wv_invoice_no, 5, '0', STR_PAD_LEFT);
        }
    }

    public function updatedSbInvoiceNo()
    {
        if($this->sb_invoice_no != null){
            $this->sb_invoice_no = ltrim($this->sb_invoice_no, 'SB-');
            $this->sb_invoice_no = ltrim($this->sb_invoice_no, '0');
            $this->sb_invoice_no = 'SB-'. str_pad($this->sb_invoice_no, 5, '0', STR_PAD_LEFT);
        }
    }

    public function updatedInvoiceTypeId($id)
    {
        $this->receipt_no = '';
        if($id == EnumsInvoiceTypes::WV){

            if($this->serviceInvoiceId != null && $this->transaction_status == TransactionStatus::POSTED){
                $this->temp_wv_invoice_no = $this->wv_invoice_no;
                $this->temp_sb_date = $this->wv_date;
            }else{
                $this->sb_invoice_no = null;
                $this->sb_date = null;
            }

            $this->for = ForTransaction::SPQ;
                
            // Wv transaction
            $invoice_no = WvTransaction::with('getTransactionSummary')->latest('id')->first();
            if($invoice_no != null){
                    $trim = ltrim(ltrim($invoice_no->getTransactionSummary->wv_invoice_no, 'WV-'), '0');
                    $trim = (int) $trim;
                    $trim = ++$trim;
        
                    $invoice_no = 'WV-' . str_pad($trim, 5, '0', STR_PAD_LEFT);

                    $this->wv_invoice_no = $this->temp_wv_invoice_no ?? $invoice_no;
                    $this->wv_date = $this->temp_wv_date ?? $this->date;

            }else{
                $invoice_no = 'WV-' . str_pad(1, 5, '0', STR_PAD_LEFT);
    
                $this->wv_invoice_no = $this->temp_wv_invoice_no ?? $invoice_no;
                $this->wv_date = $this->temp_wv_date ?? $this->date;
            }

            if($this->jo_no != null){

                // Get the total amount for the workload
                $total_amount = 0;
                $jo_total = JobOrder::where('id', $this->jo_no)->first();
                $total_amount = $jo_total->overall_total;

                $this->listItems = [];
                // Default Journal for WV
                $this->listItems = [
                    0 => [
                        'accnt_no' => 6,
                        'account_title' => 'ACCOUNTS RECEIVABLE - TRADE',
                        'debits' => number_format($total_amount, 2),
                        'credits' => number_format(0, 2),
                    ],

                    1 => [
                        'accnt_no' => 65,
                        'account_title' => 'SALES - SPQ',
                        'debits' => number_format(0, 2),
                        'credits' => number_format($total_amount, 2),
                    ],
                ];

                $this->updated();
            }
            
        }elseif ($id == EnumsInvoiceTypes::SB){

            if($this->serviceInvoiceId != null && $this->transaction_status == TransactionStatus::POSTED){
                $this->temp_sb_invoice_no = $this->sb_invoice_no;
                $this->temp_sb_date = $this->sb_date;
            }else{
                $this->wv_invoice_no = null;
                $this->wv_date = null;
            }

            $this->for = ForTransaction::BSN;

            // Sb transaction
            $invoice_no = SbTransaction::with('getTransactionSummary')->latest('id')->first();
            if($invoice_no != null){
                $trim = ltrim(ltrim($invoice_no->getTransactionSummary->sb_invoice_no, 'SB-'), '0');
                $trim = (int) $trim;
                $trim = ++$trim;
    
                $invoice_no = 'SB-' . str_pad($trim, 5, '0', STR_PAD_LEFT);
    

                $this->sb_invoice_no = $this->temp_sb_invoice_no ?? $invoice_no;
                $this->sb_date = $this->temp_sb_date ?? $this->date;
            }else{
                $invoice_no = 'SB-' . str_pad(1, 5, '0', STR_PAD_LEFT);
    
                $this->sb_invoice_no = $this->temp_sb_invoice_no ?? $invoice_no;
                $this->sb_date = $this->temp_sb_date ?? $this->date;
            }

            if($this->jo_no != null){

                // Get the total amount for the workload
                $total_amount = 0;
                $jo_total = JobOrder::where('id', $this->jo_no)->first();
                $total_amount = $jo_total->overall_total;

                $this->listItems = [];
                // Default Journal for WV
                $this->listItems = [
                    0 => [
                        'accnt_no' => 6,
                        'account_title' => 'ACCOUNTS RECEIVABLE - TRADE',
                        'debits' => number_format($total_amount, 2),
                        'credits' => number_format(0, 2),
                    ],

                    1 => [
                        'accnt_no' => 30,
                        'account_title' => 'DEFERRED OUPUT TAX',
                        'debits' => number_format(0, 2),
                        'credits' => number_format(($total_amount / 1.12) * 0.12, 2),
                    ],

                    2 => [
                        'accnt_no' => 63,
                        'account_title' => 'SALES - SERVICES',
                        'debits' => number_format(0, 2),
                        'credits' => number_format($total_amount - ($total_amount / 1.12) * 0.12, 2),
                    ],
                ];

                $this->updated();
            }
        }

    }

    public function serviceInvoiceNumber($invoice_no, $default_receipt_for)
    {
        $this->invoice_no = $invoice_no ?? null;
        $this->receipt_for = $default_receipt_for;
    }

    public function jobOrderNumber($id)
    {
        $this->jo_no = $id;
        $this->updatedJoNo($id);
    }

    public function serviceInvoiceDate($date)
    {
        $this->date = date('Y-m-d', strtotime($date));
    }

    public function addItem()
    {
        $this->listItems[] = [
            'accnt_no' => '',
            'account_title' => '',
            'debits' =>  '',
            'credits' =>  '',
        ];
    }

    public function getChartOfAccounts($id, $list)
    {
        if (!empty($id)) {
            $chartOfAccount = ChartOfAccounts::find((int) $id);

            $this->listItems[(int) $list] = [
                'accnt_no' => $id,
                'account_title' => $chartOfAccount->account_desc,
                'debits' =>  "0.00",
                'credits' =>  "0.00",
            ];
            $this->updated();
        } else {
            $this->listItems[(int) $list] = [
                'accnt_no' => '',
                'account_title' => '',
                'debits' =>  "0.00",
                'credits' =>  "0.00",
            ];
            $this->updated();
        }
    }

    public function updatedListItems($id, $value)
    {
        if (explode('.', $value)[1] == "accnt_no") {
            $this->getChartOfAccounts($id, explode('.', $value)[0]);
        }
    }

    public function updated()
    {
        // dd($this->listItems);
        for ($i = 0; $i < sizeof($this->listItems); $i++) {
            if (!empty($this->listItems[$i]['debits'])) {
                $this->listItems[$i]['debits'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['debits']));
            }
            if (!empty($this->listItems[$i]['credits'])) {
                $this->listItems[$i]['credits'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['credits']));
            }
        }

        $totalDebits = 0;
        $totalCredits = 0;
        foreach ($this->listItems as $key => $item) {
            $this->listItems[$key]['debits'] = empty($item['debits']) ? 0.00 : (is_numeric($item['debits']) ? $item['debits'] : 0.00);
            $this->listItems[$key]['credits'] = empty($item['credits']) ? 0.00 : (is_numeric($item['credits']) ? $item['credits'] : 0.00);

            $totalDebits += round($this->listItems[$key]['debits'], 2);
            $totalCredits += round($this->listItems[$key]['credits'], 2);
        }
        $this->all_total_debits = $totalDebits;
        $this->all_total_credits = $totalCredits;
        $this->all_total_debits = number_format($this->all_total_debits, 2);
        $this->all_total_credits = number_format($this->all_total_credits, 2);

        for ($i = 0; $i < sizeof($this->listItems); $i++) {
            if ($this->listItems[$i]['debits'] == 0.00) {
                $this->listItems[$i]['debits'] = "0.00";
            } else {
                $this->listItems[$i]['debits'] = number_format((float) $this->listItems[$i]['debits'], 2);
            }
            if ($this->listItems[$i]['credits'] == 0.00) {
                $this->listItems[$i]['credits'] = "0.00";
            } else {
                $this->listItems[$i]['credits'] = number_format((float) $this->listItems[$i]['credits'], 2);
            }
        }
    }

    public function updatedJoNo($id)
    {
        if (!empty($id)) {
            $joborder = JobOrder::with('clientProfile')->where('id', $id)->first();
            
            $this->customer_name = $joborder->clientProfile->name;
            // Get the total amount for the workload
            $total_amount = 0;
            $total_amount = $joborder->overall_total;

            // Disable the invoice no
            $this->toBeDisableSb = TransactionSummary::where('jo_no', $id)->where('receipt_no', 'LIKE', '%SB%')->first();
            $this->toBeDisableWv = TransactionSummary::where('jo_no', $id)->where('receipt_no', 'LIKE', '%WV%')->first();

            if ($this->receipt_no) {
                if (strstr($this->receipt_no, '-', true) == "SB") {
                    $this->for = ForTransaction::BSN; // 2 for BSN

                    // Get the invoice id
                    if (strstr($this->receipt_no, '-', true) == "SB" && $this->jo_no) {
                        $this->listItems = [];
                        // Default Journal for SB
                        $this->listItems = [
                            0 => [
                                'accnt_no' => 6,
                                'account_title' => 'ACCOUNTS RECEIVABLE - TRADE',
                                'debits' => number_format($total_amount, 2),
                                'credits' => number_format(0, 2),
                            ],

                            1 => [
                                'accnt_no' => 30,
                                'account_title' => 'DEFERRED OUPUT TAX',
                                'debits' => number_format(0, 2),
                                'credits' => number_format(($total_amount / 1.12) * 0.12, 2),
                            ],

                            2 => [
                                'accnt_no' => 63,
                                'account_title' => 'SALES - SERVICES',
                                'debits' => number_format(0, 2),
                                'credits' => number_format($total_amount - ($total_amount / 1.12) * 0.12, 2),
                            ],
                        ];

                        $this->updated();
                    }

                } elseif (strstr($this->receipt_no, '-', true) == "WV") {
                    $this->for = ForTransaction::SPQ; // 1 for SPQ


                    $this->listItems = [];
                    // Default Journal for WV
                    $this->listItems = [
                        0 => [
                            'accnt_no' => 6,
                            'account_title' => 'ACCOUNTS RECEIVABLE - TRADE',
                            'debits' => number_format($total_amount, 2),
                            'credits' => number_format(0, 2),
                        ],

                        1 => [
                            'accnt_no' => 65,
                            'account_title' => 'SALES - SPQ',
                            'debits' => number_format(0, 2),
                            'credits' => number_format($total_amount, 2),
                        ],
                    ];

                    $this->updated();
                } else {
                    $this->for = "";
                    $this->listItems = [];
                    $this->updated();
                    $this->addItem();
                }
            }
        } else {
            $this->listItems = [];
            $this->customer_name = "";
            $this->updated();
            $this->addItem();
        }
    }

    public function updatedReceiptNo($inv_no)
    {

        if ($this->jo_no) {
            // Get the total amount for the workload
            $total_amount = 0;
            $jo_total = JobOrder::where('id', $this->jo_no)->first();
            $total_amount = $jo_total->overall_total;
        }

        if ($this->jo_no) {
            if (strstr($inv_no, '-', true) == "SB") {
                $this->for = ForTransaction::BSN; // 2 for BSN

                // Get the invoice id
                if (strstr($this->receipt_no, '-', true) == "SB" && $this->jo_no) {
                    $this->listItems = [];
                    // Default Journal for SB
                    $this->listItems = [
                        0 => [
                            'accnt_no' => 6,
                            'account_title' => 'ACCOUNTS RECEIVABLE - TRADE',
                            'debits' => number_format($total_amount, 2),
                            'credits' => number_format(0, 2),
                        ],

                        1 => [
                            'accnt_no' => 30,
                            'account_title' => 'DEFERRED OUPUT TAX',
                            'debits' => number_format(0, 2),
                            'credits' => number_format(($total_amount / 1.12) * 0.12, 2),
                        ],

                        2 => [
                            'accnt_no' => 63,
                            'account_title' => 'SALES - SERVICES',
                            'debits' => number_format(0, 2),
                            'credits' => number_format($total_amount - ($total_amount / 1.12) * 0.12, 2),
                        ],
                    ];

                    $this->updated();
                }

                // if receipt no is empty the journal is empty

            } elseif (strstr($inv_no, '-', true) == "WV") {
                $this->for = ForTransaction::SPQ; // 1 for SPQ


                $this->listItems = [];
                // Default Journal for WV
                $this->listItems = [
                    0 => [
                        'accnt_no' => 6,
                        'account_title' => 'ACCOUNTS RECEIVABLE - TRADE',
                        'debits' => number_format($total_amount, 2),
                        'credits' => number_format(0, 2),
                    ],

                    1 => [
                        'accnt_no' => 65,
                        'account_title' => 'SALES - SPQ',
                        'debits' => number_format(0, 2),
                        'credits' => number_format($total_amount, 2),
                    ],
                ];

                $this->updated();
            } else {
                $this->for = "";
                $this->listItems = [];
                $this->updated();
                $this->addItem();
            }
        }
    }

    //edit
    public function serviceInvoiceId($serviceInvoiceId)
    {
        $this->listItems = [];
        $this->serviceInvoiceId = $serviceInvoiceId;
        $glAccounts = TransactionData::where('transaction_summary_id', $serviceInvoiceId)->orderBy('transaction_arrangement')->get();

        foreach ($glAccounts as $key => $value) {
            $this->listItems[$key] = [
                'transaction_summary_id' => $serviceInvoiceId, //new
                'accnt_no' => $value->account_number,
                'account_title' => $value->account_title,
                'debits' => number_format((float) $value->debits, 2),
                'credits' => number_format((float) $value->credits, 2),
            ];
        }

        $serviceInvoice = TransactionSummary::with('jobOrder')->find($serviceInvoiceId);
        $fields = ['date', 'receipt_no', 'receipt_for', 'for', 'jo_no', 'customer_name', 'sb_date', 'all_total_debits', 'all_total_credits', 'remark_id', 'invoice_type_id', 'wv_invoice_no', 'wv_date', 'sb_invoice_no', 'transaction_status_id', 'time'];
        for ($i = 0; $i < sizeof($fields); $i++) {
            $this->{$fields[$i]} = $serviceInvoice->{$fields[$i]};
        }
        $this->date = date('Y-m-d', strtotime("$this->date"));
        $this->all_total_debits = number_format($this->all_total_debits, 2);
        $this->all_total_credits = number_format($this->all_total_credits, 2);
        $this->old_invoice_type_id = $this->invoice_type_id;

        // invoice no. dropdown
        $invoice_types = InvoiceTypes::all();
        $this->invoice_no = [];
        foreach ($invoice_types as $value) {
            $this->invoice_no[$value->invoice_type . substr($serviceInvoice->receipt_no, 2)] = $value->invoice_type . substr($serviceInvoice->receipt_no, 2);
        }

        $this->temp_wv_invoice_no = $this->wv_invoice_no;
        $this->temp_wv_date = $this->wv_date;
        $this->temp_sb_invoice_no = $this->sb_invoice_no;
        $this->temp_sb_date = $this->sb_date;
        $this->transaction_status = $serviceInvoice->transaction_status_id;
        if($serviceInvoice->transaction_status_id == 2 || $serviceInvoice->transaction_status_id == 3){
            $this->post_jo_no = $serviceInvoice->jobOrder->jo_no;
        }

        if($this->wv_invoice_no != null && $this->sb_invoice_no != null){
            $this->isWvSb = true;
        }
    }

    public function store(TransactionService $transactionService, IncentiveService $incentiveService)
    {
        $this->transactionService = $transactionService;

        $data = $this->validate([
            'date' => 'required',
            'receipt_for' => 'required',
            'for' => 'required',
            'jo_no' => 'required',
            'customer_name' => 'required',
            'sb_date' => 'nullable',
            'all_total_debits' => 'required|same:all_total_credits',
            'all_total_credits' => 'required',
            'remark_id' => 'nullable',
            'time' => 'required',
            'invoice_type_id' => 'required',
            'wv_invoice_no' => ['nullable', Rule::unique('transaction_summaries', 'wv_invoice_no')->ignore($this->serviceInvoiceId)],
            'wv_date' => 'nullable',
            'sb_invoice_no' => ['nullable', Rule::unique('transaction_summaries', 'sb_invoice_no')->ignore($this->serviceInvoiceId)],
        ]);

        $data['transaction_type_id'] = EnumsServiceInvoice::SERVICE_INVOICE;
        // dd($this->time);
        $this->time = $this->time . ":00";
        $data['date'] = date('Y-m-d H:i:s', strtotime("$this->date $this->time"));
        try {

            if ($this->serviceInvoiceId) {

                    $getJo = JobOrder::where('id', $this->jo_no)->first();

                    if(!($this->old_invoice_type_id != $this->invoice_type_id && $this->transaction_status_id == 1)){
                        // Check if the JO overall_total is the same with the debits and credits in service invoice validation
                        if($getJo->overall_total == floatval(preg_replace('/[^\d.]/', '', $this->all_total_debits)) && $getJo->overall_total == floatval(preg_replace('/[^\d.]/', '', $this->all_total_credits))){
                            // Update
                            $this->transactionService->transactionSummary($data, $this->serviceInvoiceId);
                            $this->transactionService->transactionData($this->serviceInvoiceId, $this->listItems, $this->oldItems, $data, null);
                        }else{
                            Session::flash('receiptPaymentsErrorNotMatch', 'The JO Acknowledgement Receipt and Service Invoice total doesn\'t match!');
                            return url()->previous();
                        }
                    }else{
                        if($getJo->overall_total == floatval(preg_replace('/[^\d.]/', '', $this->all_total_debits)) && $getJo->overall_total == floatval(preg_replace('/[^\d.]/', '', $this->all_total_credits))){
                            // Update
                            $this->transactionService->transactionSummary($data, $this->serviceInvoiceId);
                            $this->transactionService->transactionData($this->serviceInvoiceId, $this->listItems, $this->oldItems, $data, null);
                        }else{
                            Session::flash('receiptPaymentsErrorNotMatch', 'The JO Acknowledgement Receipt and Service Invoice total doesn\'t match!');
                            return url()->previous();
                        }

                        if($this->old_invoice_type_id == 1 ){
                            // Delete the latest sb count
                            $sb_transac = SbTransaction::with('getTransactionSummary')->latest('id')->first();
                            $sb_transac->delete();
                            // Add a new wv count
                            WvTransaction::create([
                                'transaction_summary_id' => $this->serviceInvoiceId,
                            ]);
                        }else{
                            // Delete the latest wv count
                            $wv_transac = WvTransaction::with('getTransactionSummary')->latest('id')->first();
                            $wv_transac->delete();
                            // Add a new sb count
                            SbTransaction::create([
                                'transaction_summary_id' => $this->serviceInvoiceId,
                            ]);
                        }
                    }

                // Update the receipts payments into setup status
                if($this->wv_invoice_no && $this->sb_invoice_no){

                    // Turn back the JO to unpaid
                    $transaction = TransactionSummary::with('jobOrder')->where('id', $this->serviceInvoiceId)->first();
                    $transaction->jobOrder->update([
                        'payment_status_id' => Status::UNPAID,
                    ]);

                    // Save SB transaction
                    SbTransaction::create([
                        'transaction_summary_id' => $this->serviceInvoiceId,
                    ]);

                    // Update the service invoice back to unpaid
                    $transaction->update(['status_id' => Status::UNPAID]);

                    $this->transactionService->transactionParticulars($this->serviceInvoiceId);

                    $this->incentiveService = $incentiveService;
                    $total_incentive = $this->incentiveService->calculateIncentive($transaction->jo_no);

                    JobOrder::where('id', $transaction->jo_no)->update([
                        'total_incentive' => $total_incentive, 
                    ]);
                }
                
            } else {

                // Check if the JO overall_total is the same with the debits and credits in service invoice validation
                $getJo = JobOrder::where('id', $this->jo_no)->first();
                if($getJo->overall_total == floatval(preg_replace('/[^\d.]/', '', $this->all_total_debits)) && $getJo->overall_total == floatval(preg_replace('/[^\d.]/', '', $this->all_total_credits))){

                    // Add a default value for transaction status
                    $data['transaction_status_id'] = TransactionStatus::SETUP;
                    // Create

                    $createTransactionId = $this->transactionService->transactionSummary($data, $this->serviceInvoiceId);

                    $this->transactionService->transactionData($this->serviceInvoiceId, $this->listItems, $this->oldItems, $data, $createTransactionId);

                    if($this->sb_invoice_no != null){
                        SbTransaction::create([
                            'transaction_summary_id' => $createTransactionId,
                        ]);
                    }else{
                        WvTransaction::create([
                            'transaction_summary_id' => $createTransactionId,
                        ]);
                    }

                }else{
                    Session::flash('receiptPaymentsErrorNotMatch', 'The JO Acknowledgement Receipt and Service Invoice total doesn\'t match!');
                    return url()->previous();
                }
            }
        } catch (\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->serviceInvoiceId) {
            $action = 'edit';
            $message = 'Service Invoice Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Service Invoice Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('refreshParentServiceInvoice');
        $this->emit('closeJournalizeModal');
        $this->emit('closeServiceInvoiceModal');
        return redirect()->to('/service-invoice');
    }

    public function deleteItem($index)
    {
        unset($this->listItems[$index]);
        $this->listItems = array_values($this->listItems);

        $this->updated();
    }

    public function transactionConfirmServiceInvoice($serviceInvoiceId)
    {
        $this->dispatchBrowserEvent('swal:confirmServiceInvoiceTransaction', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, accept it!',
            'id' => $serviceInvoiceId,
        ]);

    }

    //Update the transaction status id
    public function postServiceInvoice($serviceInvoiceId, ?IncentiveService $incentiveService)
    {
        $transaction = TransactionSummary::find($serviceInvoiceId);
        $transaction->update([
            'transaction_status_id' => TransactionStatus::POSTED,
        ]);
        
        $totalIncentive = $incentiveService->calculateIncentive($transaction->jo_no);

        JobOrder::where('id', $transaction->jo_no)->update([
            'total_incentive' => $totalIncentive, 
        ]);

        $this->emit('refreshParent');
        $this->emit('closeServiceInvoiceModal');
        return redirect()->to('/service-invoice');
    }

    public function render()
    {
        $report_data = TransactionSummary::with('jobOrder.clientProfile', 'receiptFor', 'fors')->where('id', $this->serviceInvoiceId)->get();
        $items = TransactionData::with('chartOfAccounts')->where('transaction_summary_id', $this->serviceInvoiceId)->orderBy('transaction_arrangement')->get();
        $this->listInvoices = TransactionSummary::where('transaction_type_id', 2)->whereIn('transaction_status_id', [1,2])->whereIn('status_id', [12,13])->pluck('jo_no');
        return view('livewire.billing.service-invoice-form', [
            'accout_numbers' => ChartOfAccounts::all(),
            'job_orders' => JobOrder::where('overall_total', '!=' , null)->where('payment_status_id', 13)->get(),
            'receipt_fors' => ReceiptFor::all(),
            'fors' => TransactionFor::all(),
            'report_datas' => $report_data,
            'items' => $items,
            'listInvoices' => $this->listInvoices,
            'remarks' => Remark::all(),
            'invoice_types' => InvoiceTypes::all(),
        ]);
    }
}
