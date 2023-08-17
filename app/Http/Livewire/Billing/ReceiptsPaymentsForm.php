<?php

namespace App\Http\Livewire\Billing;

use App\Enums\Bank as EnumsBank;
use App\Enums\ForTransaction;
use App\Enums\ReceiptType;
use App\Enums\ServiceInvoice;
use App\Enums\Status;
use App\Enums\TransactionStatus;
use App\Models\ArTransaction;
use App\Models\Bank;
use App\Models\ChartOfAccounts;
use App\Models\ClientProfile;
use App\Models\Collect;
use App\Models\JobOrder;
use App\Models\OrTransaction;
use App\Models\PaymentType;
use App\Models\ReceiptFor;
use App\Models\ReceiptTypes;
use App\Models\TransactionData;
use App\Models\TransactionFor;
use App\Models\TransactionParticular;
use App\Models\TransactionSummary;
use App\Models\TransactionTypes;
use App\Models\WorkOrder;
use App\Service\TransactionService;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use PDF;

class ReceiptsPaymentsForm extends Component
{
    public $date, $receipt_type_id, $receipt_for, $for, /*$jo_no, $customer_name,*/ $bank, $gl_account_bank, $sb_date, $serviceInvoiceId, $accnt_no, $account_title, $debits, $credits, $all_total_debits, $all_total_credits, $client_id;
    public $listItems = [];
    public $oldItems = [];
    public $action = '';
    public $message = '';
    public $invoice_no = [];
    private $transactionService;
    public $transaction_status,$receipt, $ar_transaction, $or_transaction, $temp_ar_transaction, $temp_or_transaction, $transaction_status_id;
    public $particulars = [];
    public $total_amount = 0;
    public $inv_total_amount = 0;
    public $all_total_paid, $all_this_payment, $collected_by_id, $payment_type_id, $customer_bank_id, $cheque_no, $dated, $ar_receipt_id, $or_receipt_id, $oldReceipt;
    public $old_receipt_type_id;

    protected $listeners = [
        'refreshParentBank' => '$refresh',
        'serviceInvoiceId',
        'resetInputFields',
        'serviceInvoiceDate',
        'serviceInvoiceNumber',
        'selectedClient',
    ];

    public function hydrate(){
        $this->emit('select2');
    }

    public function selectedClient($id)
    {
        if($id){
            $this->client_id = $id;
            $this->listItems = [];
            $this->particulars = [];
            $this->addItem();
            $this->updated();
    
            if($this->receipt_type_id == ReceiptType::AR){

                $parti = TransactionSummary::with('jobOrder')
                ->where('transaction_type_id', 2)
                ->where('transaction_status_id', 2)
                // ->where('wv_invoice_no', 'LIKE', '%WV%')
                ->where('invoice_type_id', 2)
                ->where('status_id', 13)
                ->whereHas('jobOrder', function ($query) use($id) {
                    return $query->where('customer_id', '=', $id);
                })->get();
    
                foreach ($parti as $key => $value) {
                    // Check if the transaction already existed in the particulars
                    if(TransactionParticular::where('transaction_summary_invoice_id', $value->id)->count() > 0){
                        continue;
                    }else{
                        $this->particulars[$key] = [
                            'transaction_id' => $value->id, //new
                            'wv_invoice_no' => $value->wv_invoice_no ?? '', //new
                            'sb_invoice_no' => $value->sb_invoice_no ?? '', //new
                            'ref_date' => date('Y-m-d', strtotime($value->jobOrder->date)),
                            'terms' => $value->jobOrder->term,
                            'inv_amount' => number_format($value->jobOrder->overall_total, 2),
                            'total_paid' => '',
                            'this_payment' => '',
                        ];
                    }
                }
    
            }elseif($this->receipt_type_id == ReceiptType::OR){
                $parti = TransactionSummary::with('jobOrder')
                ->where('transaction_type_id', 2)
                ->where('transaction_status_id', 2)
                // ->where('sb_invoice_no', 'LIKE', '%SB%')
                ->where('invoice_type_id', 1)
                ->where('status_id', 13)
                ->whereHas('jobOrder', function ($query) use($id) {
                    return $query->where('customer_id', '=', $id);
                })->get();
    
                foreach ($parti as $key => $value) {
                    // Check if the transaction already existed in the particulars
                    if(TransactionParticular::where('transaction_summary_invoice_id', $value->id)->count() > 0){
                        continue;
                    }else{
                        $this->particulars[$key] = [
                            'transaction_id' => $value->id, //new
                            'wv_invoice_no' => $value->wv_invoice_no ?? '', //new
                            'sb_invoice_no' => $value->sb_invoice_no ?? '', //new
                            'ref_date' => date('Y-m-d', strtotime($value->jobOrder->date)),
                            'terms' => $value->jobOrder->term,
                            'inv_amount' => number_format($value->jobOrder->overall_total, 2),
                            'total_paid' => '',
                            'this_payment' => '',
                        ];
                    }
                }
            }

            $this->updatedParticulars();
        }
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->addItem();
    }

    public function updatedReceipt()
    {
        if($this->receipt){
            if($this->receipt_type_id == 1){
                if($this->receipt != null){
                    $this->receipt = ltrim($this->receipt, 'OR-');
                    $this->receipt = ltrim($this->receipt, '0');
                    $this->receipt = 'AR-'. str_pad($this->receipt, 5, '0', STR_PAD_LEFT);
                }
                $this->receipt = ltrim($this->receipt, 'AR-');
                $this->receipt = ltrim($this->receipt, '0');
                $this->receipt = 'AR-'. str_pad($this->receipt, 5, '0', STR_PAD_LEFT);
            }elseif($this->receipt_type_id == 2){
                if($this->receipt != null){
                    $this->receipt = ltrim($this->receipt, 'AR-');
                    $this->receipt = ltrim($this->receipt, '0');
                    $this->receipt = 'OR-'. str_pad($this->receipt, 5, '0', STR_PAD_LEFT);
                }
                $this->receipt = ltrim($this->receipt, 'OR-');
                $this->receipt = ltrim($this->receipt, '0');
                $this->receipt = 'OR-'. str_pad($this->receipt, 5, '0', STR_PAD_LEFT);
            }
        }
    }

    public function updatedArTransaction()
    {
        if($this->ar_transaction != null){
            $this->ar_transaction = ltrim($this->ar_transaction, 'AR-');
            $this->ar_transaction = ltrim($this->ar_transaction, '0');
            $this->ar_transaction = 'AR-'. str_pad($this->ar_transaction, 5, '0', STR_PAD_LEFT);
        }
    }

    public function updatedOrTransaction()
    {
        if($this->or_transaction != null){
            $this->or_transaction = ltrim($this->or_transaction, 'OR-');
            $this->or_transaction = ltrim($this->or_transaction, '0');
            $this->or_transaction = 'OR-'. str_pad($this->or_transaction, 5, '0', STR_PAD_LEFT);
        }
    }

    public function updatedParticulars()
    {
        $this->particulars = array_values($this->particulars);
        $this->total_amount = 0;
        $this->inv_total_amount = 0;
        for($i = 0; $i < sizeof($this->particulars); $i++)
        {
            if(!empty($this->particulars[$i]['total_paid'])){
                $this->particulars[$i]['total_paid'] = floatval(preg_replace('/[^\d.]/', '', $this->particulars[$i]['total_paid']));
            }
            if(!empty($this->particulars[$i]['this_payment'])){
                $this->particulars[$i]['this_payment'] = floatval(preg_replace('/[^\d.]/', '', $this->particulars[$i]['this_payment']));
            }
        }

        $total_paid = 0;
        $this_payment = 0;
        foreach ($this->particulars as $key => $item) {
            $this->particulars[$key]['total_paid'] = empty($item['total_paid']) ? 0.00 : (is_numeric($item['total_paid'])? $item['total_paid']: 0.00);
            $this->particulars[$key]['this_payment'] = empty($item['this_payment']) ? 0.00 : (is_numeric($item['this_payment'])? $item['this_payment']: 0.00);

            $this->particulars[$key]['this_payment'] = $this->particulars[$key]['total_paid'];
            $total_paid += round($this->particulars[$key]['total_paid'],2);
            $this_payment += round($this->particulars[$key]['this_payment'],2);

        }
        $this->all_total_paid = $total_paid;
        $this->all_this_payment = $this_payment;
        $this->all_total_paid = number_format($this->all_total_paid, 2);
        $this->all_this_payment = number_format($this->all_this_payment, 2);

        foreach ($this->particulars as $data) {
            $this->total_amount += (double) $data['total_paid'];

            if($data['total_paid'] > 0 && $data['inv_amount'] > 0){
                $this->inv_total_amount += floatval(preg_replace('/[^\d.]/', '', $data['inv_amount']));
            }

        }


        for($i = 0; $i < sizeof($this->particulars); $i++)
        {
            if($this->particulars[$i]['total_paid'] == 0.00){
                $this->particulars[$i]['total_paid'] = "0.00";
            }else{
                $this->particulars[$i]['total_paid'] = number_format((double) $this->particulars[$i]['total_paid'], 2);
            }
            if($this->particulars[$i]['this_payment'] == 0.00){
                $this->particulars[$i]['this_payment'] = "0.00";
            }else{
                $this->particulars[$i]['this_payment'] = number_format((double) $this->particulars[$i]['this_payment'], 2);
            }
        }

        if($this->receipt_type_id == ReceiptType::AR){

                $this->listItems = [
                    0 => [
                        'accnt_no' => 3,
                        'account_title' => 'CASH IN BANK - BDO (SO)',
                        'debits' => number_format($this->total_amount, 2),
                        'credits' => number_format(0, 2),
                    ],

                    1 => [
                        'accnt_no' => 6,
                        'account_title' => 'ACCOUNTS RECEIVABLE - TRADE',
                        'debits' => number_format(0, 2),
                        'credits' => number_format($this->total_amount, 2),
                    ],
                ];
                $this->updated();

        }elseif($this->receipt_type_id == ReceiptType::OR){

                if($this->total_amount <  $this->inv_total_amount){
                    // $this->total_amount = $this->inv_total_amount;
                }

                $this->listItems = [
                    0 => [
                        'accnt_no' => 4,
                        'account_title' => 'CASH IN BANK - MBTC',
                        'debits' => number_format($this->total_amount, 2),
                        'credits' => number_format(0, 2),
                    ],

                    1 => [
                        'accnt_no' => 30,
                        'account_title' => 'DEFERRED OUPUT TAX',
                        'debits' => number_format(($this->total_amount / 1.12) * 0.12, 2),
                        'credits' => number_format(0, 2),
                    ],

                    2 => [
                        'accnt_no' => 54,
                        'account_title' => 'OUPUT TAX PAYABLE',
                        'debits' => number_format(0, 2),
                        'credits' => number_format(($this->total_amount / 1.12) * 0.12, 2),
                    ],

                    3 => [
                        'accnt_no' => 6,
                        'account_title' => 'ACCOUNTS RECEIVABLE - TRADE',
                        'debits' => number_format(0, 2),
                        'credits' => number_format($this->total_amount, 2),
                    ],
                ];
                $this->updated();

        }
    }

    public function updatedReceiptTypeId($id)
    {
        // Update the bank
        $this->particulars = [];

        if($id == ReceiptType::AR){
            $this->for = ForTransaction::SPQ;
            $this->bank = EnumsBank::BDO;
            $this->updatedBank(EnumsBank::BDO);

            $this->updatedReceipt();
            
                if($this->client_id){

                    $parti = TransactionSummary::with('jobOrder')
                    ->where('transaction_type_id', 2)
                    ->where('transaction_status_id', 2)
                    // ->where('wv_invoice_no', 'LIKE', '%WV%')
                    ->where('invoice_type_id', 2)
                    ->where('status_id', 13)
                    ->whereHas('jobOrder', function ($query) {
                        return $query->where('customer_id', '=', $this->client_id);
                    })->get();  
            
                    foreach ($parti as $key => $value) {
                        // Check if the transaction already existed in the particulars
                        if(TransactionParticular::where('transaction_summary_invoice_id', $value->id)->count() > 0){
                            continue;
                        }else{
                            $this->particulars[$key] = [
                                'transaction_id' => $value->id, //new
                                'wv_invoice_no' => $value->wv_invoice_no ?? '', //new
                                'sb_invoice_no' => $value->sb_invoice_no ?? '', //new
                                'ref_date' => date('Y-m-d', strtotime($value->jobOrder->date)),
                                'terms' => $value->jobOrder->term,
                                'inv_amount' => number_format($value->jobOrder->overall_total, 2),
                                'total_paid' => '',
                                'this_payment' => '',
                            ];
                        }

                    }
                }

                // Update the receipt get the latest id
                $lastArId = ArTransaction::latest('id')->first();
                if($lastArId != null){
                    $possible_next_value = ArTransaction::with('getTransactionSummary')->where('transaction_summary_id', $lastArId->transaction_summary_id)->first();
                    if(!$this->serviceInvoiceId){
                        // Get the possible next value
                        if($possible_next_value->getTransactionSummary->receipt_type_id == 1){
                            if(strstr($possible_next_value->getTransactionSummary->ar_transaction, '-', true) == "AR"){
                                $this->ar_transaction = ltrim($possible_next_value->getTransactionSummary->ar_transaction, 'AR-');
                                $this->ar_transaction = ltrim($this->ar_transaction, '0');
                                $this->ar_transaction = 'AR-'. str_pad((int) $this->ar_transaction + 1, 5, '0', STR_PAD_LEFT);
                            }else{
                                $this->ar_transaction = 'AR-'. str_pad(1, 5, '0', STR_PAD_LEFT);
                            }
                        }else{
                            $this->ar_transaction = ltrim($possible_next_value->getTransactionSummary->ar_transaction, 'AR-');
                            $this->ar_transaction = ltrim($this->ar_transaction, '0');
                            $this->ar_transaction = 'AR-'. str_pad($this->ar_transaction, 5, '0', STR_PAD_LEFT);
                        }

                    }else{

                        if(strstr($this->ar_transaction, '-', true) == "AR"){
                            $this->ar_transaction = $this->ar_transaction;
                        }else{
                            $this->ar_transaction = ltrim($possible_next_value->getTransactionSummary->ar_transaction, 'AR-');
                            $this->ar_transaction = ltrim($this->ar_transaction, '0');
                            $this->ar_transaction = 'AR-'. str_pad((int) $this->ar_transaction + 1, 5, '0', STR_PAD_LEFT);
                        }
                    }
                }else{
                    $this->ar_transaction = 'AR-'. str_pad(1, 5, '0', STR_PAD_LEFT);
                }

        }elseif($id == ReceiptType::OR){
            $this->for = ForTransaction::BSN;
            $this->bank = EnumsBank::MTBC;
            $this->updatedBank(EnumsBank::MTBC);

            $this->updatedReceipt();

                if($this->client_id){

                    $parti = TransactionSummary::with('jobOrder')
                    ->where('transaction_type_id', 2)
                    ->where('transaction_status_id', 2)
                    // ->where('sb_invoice_no', 'LIKE', '%SB%')
                    ->where('invoice_type_id', 1)
                    ->where('status_id', 13)
                    ->whereHas('jobOrder', function ($query) {
                        return $query->where('customer_id', '=', $this->client_id);
                    })->get();  
            
                    foreach ($parti as $key => $value) {
                        // Check if the transaction already existed in the particulars
                        if(TransactionParticular::where('transaction_summary_invoice_id', $value->id)->count() > 0){
                            continue;
                        }else{
                        $this->particulars[$key] = [
                            'transaction_id' => $value->id, //new
                            'wv_invoice_no' => $value->wv_invoice_no ?? '', //new
                            'sb_invoice_no' => $value->sb_invoice_no ?? '', //new
                            'ref_date' => date('Y-m-d', strtotime($value->jobOrder->date)),
                            'terms' => $value->jobOrder->term,
                            'inv_amount' => number_format($value->jobOrder->overall_total, 2),
                            'total_paid' => '',
                            'this_payment' => '',
                        ];
                        }
                    }
                }



                // Update the receipt get the latest id
                $lastOrId = OrTransaction::latest('id')->first();

                if($lastOrId != null){
                    $possible_next_value = OrTransaction::with('getTransactionSummary')->where('transaction_summary_id', $lastOrId->transaction_summary_id)->first();
                    if(!$this->serviceInvoiceId){
                        // Get the possible next value
                        if($possible_next_value->getTransactionSummary->receipt_type_id == 2){
                            if(strstr($possible_next_value->getTransactionSummary->or_transaction, '-', true) == "OR"){
                                $this->or_transaction = ltrim($possible_next_value->getTransactionSummary->or_transaction, 'OR-');
                                $this->or_transaction = ltrim($this->or_transaction, '0');
                                $this->or_transaction = 'OR-'. str_pad((int) $this->or_transaction + 1, 5, '0', STR_PAD_LEFT);
                            }else{
                                $this->or_transaction = 'OR-'. str_pad(1, 5, '0', STR_PAD_LEFT);
                            }
                        }else{
                            $this->or_transaction = ltrim($possible_next_value->getTransactionSummary->or_transaction, 'OR-');
                            $this->or_transaction = ltrim($this->or_transaction, '0');
                            $this->or_transaction = 'OR-'. str_pad($this->or_transaction, 5, '0', STR_PAD_LEFT);
                        }
                    }else{

                        if(strstr($this->or_transaction, '-', true) == "OR"){
                            $this->or_transaction = $this->or_transaction;
                        }else{
                            $this->or_transaction = ltrim($possible_next_value->getTransactionSummary->or_transaction, 'OR-');
                            $this->or_transaction = ltrim($this->or_transaction, '0');
                            $this->or_transaction = 'OR-'. str_pad((int) $this->or_transaction + 1, 5, '0', STR_PAD_LEFT);
                        }
                    }
                }else{
                    $this->or_transaction = 'OR-'. str_pad(1, 5, '0', STR_PAD_LEFT);
                }

                

        }else{
            $this->for = "";
            $this->bank = "";
            $this->gl_account_bank = "";
        }

        $this->updatedParticulars();
    }

    public function updatedFor($id)
    {
        if($id == 1){
            $this->receipt_type_id = 1;
        }elseif($id == 2){
            $this->receipt_type_id = 2;
        }
    }

    public function mount()
    {
        $this->addItem();
    }

    public function serviceInvoiceNumber($invoice_no, $defaultReceiptFor)
    {
        $this->invoice_no = $invoice_no ?? null;
        $this->receipt_for = $defaultReceiptFor;
    }

    public function serviceInvoiceDate($date)
    {
        $this->date = date('Y-m-d', strtotime($date));
        $this->sb_date = date('Y-m-d', strtotime($date));
    }

    public function addItem()
    {
        $this->listItems[] = [
            'accnt_no' =>'',
            'account_title' => '',
            'debits' =>  '',
            'credits' =>  '',
        ];
    }

    public function getChartOfAccounts($id, $list)
    {
        if(!empty($id)){
            $chartOfAccount = ChartOfAccounts::find((int) $id);

            $this->listItems[(int) $list] = [
                'accnt_no' => $id,
                'account_title' => $chartOfAccount->account_desc,
                'debits' =>  "0.00",
                'credits' =>  "0.00",
            ];
            $this->updated();
        }else{
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
        if(explode('.', $value)[1] == "accnt_no"){
            $this->getChartOfAccounts($id, explode('.', $value)[0]);
            
        }
    }

    public function updatedBank($id)
    {
        // dd($id);
        if(!empty($id)){
            $bank = Bank::with('chartOfAccounts')->where('id',$id)->get();

            foreach ($bank as $accounts) {
                if($accounts->chartOfAccounts != null){
                    $this->gl_account_bank = $accounts->chartOfAccounts->account_code . " = " .$accounts->chartOfAccounts->account_desc;
                }else{
                    $this->gl_account_bank = "";
                }
            }

        }else{
            $this->gl_account_bank = "";
        }
    }

    public function updated()
    {
            for($i = 0; $i < sizeof($this->listItems); $i++)
            {
                if(!empty($this->listItems[$i]['debits'])){
                    $this->listItems[$i]['debits'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['debits']));
                }
                if(!empty($this->listItems[$i]['credits'])){
                    $this->listItems[$i]['credits'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['credits']));
                }
            }

        $totalDebits = 0;
        $totalCredits = 0;
        foreach ($this->listItems as $key => $item) {
			$this->listItems[$key]['debits'] = empty($item['debits']) ? 0.00 : (is_numeric($item['debits'])? $item['debits']: 0.00);
            $this->listItems[$key]['credits'] = empty($item['credits']) ? 0.00 : (is_numeric($item['credits'])? $item['credits']: 0.00);

            $totalDebits += round($this->listItems[$key]['debits'],2);
            $totalCredits += round($this->listItems[$key]['credits'],2);
		}
        $this->all_total_debits = $totalDebits;
        $this->all_total_credits = $totalCredits;
        $this->all_total_debits = number_format($this->all_total_debits, 2);
        $this->all_total_credits = number_format($this->all_total_credits, 2);

        // if ($this->serviceInvoiceId) {
            for($i = 0; $i < sizeof($this->listItems); $i++)
            {
                if($this->listItems[$i]['debits'] == 0.00){
                    $this->listItems[$i]['debits'] = "0.00";
                }else{
                    $this->listItems[$i]['debits'] = number_format((double) $this->listItems[$i]['debits'], 2);
                }
                if($this->listItems[$i]['credits'] == 0.00){
                    $this->listItems[$i]['credits'] = "0.00";
                }else{
                    $this->listItems[$i]['credits'] = number_format((double) $this->listItems[$i]['credits'], 2);
                }

            }
        // }
    }

    //edit
    public function serviceInvoiceId($serviceInvoiceId)
    {
        $this->particulars = [];
        $this->listItems = [];
        $this->serviceInvoiceId = $serviceInvoiceId;
        $glAccounts = TransactionData::where('transaction_summary_id', $serviceInvoiceId)->orderBy('transaction_arrangement')->get();

        $i =0;
        foreach ($glAccounts as $value) {
            $this->listItems[$i] = [
                'transaction_summary_id' => $serviceInvoiceId, //new
                'accnt_no' => $value->account_number,
                'account_title' => $value->account_title,
                'debits' => number_format((double) $value->debits, 2),
                'credits' => number_format((double) $value->credits, 2),
            ];
            $i++;
        }

        $serviceInvoice = TransactionSummary::find($serviceInvoiceId);
        $fields = ['date', 'receipt_type_id', 'receipt_for', 'for', 'bank', 'gl_account_bank', 'sb_date', 'all_total_debits', 'all_total_credits', 'client_id', 'collected_by_id', 'payment_type_id', 'customer_bank_id', 'dated', 'cheque_no', 'receipt', 'ar_transaction', 'or_transaction', 'transaction_status_id'];
        for($i=0; $i < sizeof($fields); $i++){
            $this->{$fields[$i]} = $serviceInvoice->{$fields[$i]} ?? '';
        }
        $this->old_receipt_type_id = $this->receipt_type_id;
        $this->date = date('Y-m-d', strtotime("$this->date"));
        // get the transaction summary invoice in transaction particulars
        $prtclrs = TransactionParticular::with('transactionSummaryReceipt')->where('transaction_summary_receipt_id', $serviceInvoiceId)->get();

        // 
        $id = [];
        foreach ($prtclrs as $key => $value) {
            $id[] = $value['transaction_summary_invoice_id']; 
        }

        // get the transaction summary invoice in transaction particulars
        $prtclrs = TransactionParticular::with('transactionSummaryInvoice.jobOrder')->whereIn('transaction_summary_invoice_id', $id)->get();

        foreach ($prtclrs as $key => $value) {
            if($value->transactionSummaryInvoice->sb_invoice_no != null){
                $this->particulars[$key] = [
                    'transaction_id' => $value->transaction_summary_invoice_id, //new
                    'wv_invoice_no' => $value->transactionSummaryInvoice->wv_invoice_no ?? '', //new
                    'sb_invoice_no' => $value->transactionSummaryInvoice->sb_invoice_no ?? '', //new
                    'ref_date' => date('Y-m-d', strtotime($value->transactionSummaryInvoice->jobOrder->date)),
                    'terms' => $value->transactionSummaryInvoice->jobOrder->term,
                    'inv_amount' => number_format($value->transactionSummaryInvoice->jobOrder->overall_total, 2),
                    'total_paid' => $value->total_paid,
                    'this_payment' => $value->this_payment,
                ];
            }else{
                $this->particulars[$key] = [
                    'transaction_id' => $value->transaction_summary_invoice_id, //new
                    'wv_invoice_no' => $value->transactionSummaryInvoice->wv_invoice_no ?? '', //new
                    'sb_invoice_no' => $value->transactionSummaryInvoice->sb_invoice_no ?? '', //new
                    'invoice_no' => $value->transactionSummaryInvoice->wv_invoice_no, //new
                    'ref_date' => date('Y-m-d', strtotime($value->transactionSummaryInvoice->jobOrder->date)),
                    'terms' => $value->transactionSummaryInvoice->jobOrder->term,
                    'inv_amount' => number_format($value->transactionSummaryInvoice->jobOrder->overall_total, 2),
                    'total_paid' => $value->total_paid,
                    'this_payment' => $value->this_payment,
                ];
            }

        }

        if($this->receipt_type_id == ReceiptType::AR){
            // Get all the TransactionSummary of a client which is still unpaid
            $parti = TransactionSummary::with('jobOrder')
            ->where('transaction_type_id', 2)
            ->where('transaction_status_id', 2)
            ->where('status_id', 13)
            ->where('wv_invoice_no', 'LIKE', '%WV%')
            ->whereHas('jobOrder', function ($query) {
                return $query->where('customer_id', '=', $this->client_id);
            })->pluck('id')
            ->toArray();

            foreach ($parti as $key => $value) {
                if(!in_array($value, $id)){
                    $newAdd = TransactionSummary::with('jobOrder')->where('id', $value)->get();
                    foreach ($newAdd as $key => $value) {
                        if ($value->sb_invoice_no != null && $value->wv_invoice_no != null){
                            continue;
                        }else{
                            $this->particulars[sizeof($this->particulars)+1] = [
                                'transaction_id' => $value->id, //new
                                'wv_invoice_no' => $value->wv_invoice_no ?? '', //new
                                'sb_invoice_no' => $value->sb_invoice_no ?? '', //new
                                'ref_date' => date('Y-m-d', strtotime($value->jobOrder->date)),
                                'terms' => $value->jobOrder->term,
                                'inv_amount' => number_format($value->jobOrder->overall_total, 2),
                                'total_paid' => (double) 0.00,
                                'this_payment' => (double) 0.00,
                            ];
                        }

                    }

                }
            }

            // Get the receipt
            $this->oldReceipt = $this->receipt;

        }elseif($this->receipt_type_id == ReceiptType::OR){
            // Get all the TransactionSummary of a client which is still unpaid
            $parti = TransactionSummary::with('jobOrder')
            ->where('transaction_type_id', 2)
            ->where('transaction_status_id', 2)
            ->where('status_id', 13)
            ->where('sb_invoice_no', 'LIKE', '%SB%')
            ->whereHas('jobOrder', function ($query) {
                return $query->where('customer_id', '=', $this->client_id);
            })->pluck('id')
            ->toArray();

            foreach ($parti as $key => $value) {
                if(!in_array($value, $id)){
                    $newAdd = TransactionSummary::with('jobOrder')->where('id', $value)->get();
                    foreach ($newAdd as $key => $value) {
                        $this->particulars[sizeof($this->particulars)+1] = [
                            'transaction_id' => $value->id, //new
                            'wv_invoice_no' => $value->wv_invoice_no ?? '', //new
                            'sb_invoice_no' => $value->sb_invoice_no ?? '', //new
                            'ref_date' => date('Y-m-d', strtotime($value->jobOrder->date)),
                            'terms' => $value->jobOrder->term,
                            'inv_amount' => number_format($value->jobOrder->overall_total, 2),
                            'total_paid' => (double) 0.00,
                            'this_payment' => (double) 0.00,
                        ];
                    }

                }
            }

            // Get the receipt
            $this->oldReceipt = $this->receipt;
        }

        $this->particulars = array_values($this->particulars);
        $this->oldItems = $this->listItems;

        $this->temp_ar_transaction = $this->ar_transaction; 
        $this->temp_or_transaction = $this->or_transaction;
        $this->transaction_status = $serviceInvoice->transaction_status_id;
        $this->updated();
        $this->updatedParticulars();
    }

    public function store(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;

        if($this->payment_type_id == 3){
            $data = $this->validate([
                'date' => 'required',
                'receipt_type_id' => 'required',
                'receipt_for' => 'required',
                'for' => 'required',
                'client_id' => 'required',
                'bank' => 'required',
                'gl_account_bank' => 'required',
                'sb_date' => 'required',
                'all_total_debits' => 'required|same:all_total_credits',
                'all_total_credits' => 'required',
                'collected_by_id' => 'required',
                'payment_type_id' => 'required',
                'customer_bank_id' => 'required',
                'dated' => 'required',
                'ar_transaction' => 'nullable',
                'or_transaction' => 'nullable',
                'cheque_no' => 'required',
            ]);
        }else{
            $data = $this->validate([
                'date' => 'required',
                'receipt_type_id' => 'required',
                'receipt_for' => 'required',
                'for' => 'required',
                'client_id' => 'required',
                'bank' => 'required',
                'gl_account_bank' => 'required',
                'sb_date' => 'required',
                'all_total_debits' => 'required|same:all_total_credits',
                'all_total_credits' => 'required',
                'collected_by_id' => 'required',
                'payment_type_id' => 'required',
                'ar_transaction' => 'nullable',
                'or_transaction' => 'nullable',
            ]);
        }

        if($this->receipt_type_id == ReceiptType::AR){
            foreach ($this->particulars as $key => $value) {
                if($value['total_paid'] != 0.00 && $value['this_payment'] != 0.00){
                    $this->validate([
                        'particulars.'. $key .'.total_paid' => 'same:particulars.'. $key .'.inv_amount',
                        'particulars.'. $key .'.this_payment' => 'same:particulars.'. $key .'.inv_amount',
                    ],
                    [
                        'particulars.'. $key .'.total_paid.same' => 'Does not match Inv. amount',
                        'particulars.'. $key .'.this_payment.same' => 'Does not match Inv. amount',
                    ]);
                }
            }
        }


        $data['transaction_type_id'] = ServiceInvoice::RECEIPTS_PAYMENTS;

        try {

            if ($this->serviceInvoiceId) {
                // Update
                
                $data['all_total_debits'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_debits']));
                $data['all_total_credits'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_credits']));



                if(!empty($this->particulars) && floatval(preg_replace('/[^\d.]/', '', $this->all_total_paid)) > 0 ){
                    if($this->receipt_type_id == ReceiptType::AR){
                        $this->transactionService->transactionSummary($data, $this->serviceInvoiceId);
                        $this->transactionService->transactionData($this->serviceInvoiceId, $this->listItems, $this->oldItems, $data, null);    

                        // Add to transaction_particulars
                        foreach ($this->particulars as $key => $value) {
                                TransactionParticular::updateOrCreate([
                                    'transaction_summary_invoice_id' => $value['transaction_id'],
                                    'transaction_summary_receipt_id' => $this->serviceInvoiceId,
                                ], [
                                    'total_paid' => floatval(preg_replace('/[^\d.]/', '', $value['total_paid'])),
                                    'this_payment' => floatval(preg_replace('/[^\d.]/', '', $value['this_payment'])),
                                ]);
                        }

                        if($this->temp_ar_transaction != $this->ar_transaction){
                            ArTransaction::create([
                                'transaction_summary_id' => $this->serviceInvoiceId,
                            ]);
                        }

                    }elseif($this->receipt_type_id == ReceiptType::OR){
                        $this->transactionService->transactionSummary($data, $this->serviceInvoiceId);
                        $this->transactionService->transactionData($this->serviceInvoiceId, $this->listItems, $this->oldItems, $data, null);      
                    
                        // Add to transaction_particulars
                        foreach ($this->particulars as $key => $value) {
                                TransactionParticular::updateOrCreate([
                                    'transaction_summary_invoice_id' => $value['transaction_id'],
                                    'transaction_summary_receipt_id' => $this->serviceInvoiceId,
                                ], [
                                    'total_paid' => floatval(preg_replace('/[^\d.]/', '', $value['total_paid'])),
                                    'this_payment' => floatval(preg_replace('/[^\d.]/', '', $value['this_payment'])),
                                ]);
                        }

                        if($this->temp_or_transaction != $this->or_transaction){
                            OrTransaction::create([
                                'transaction_summary_id' => $this->serviceInvoiceId,
                            ]);
                        }
                    }
                }else{
                    Session::flash('receiptPaymentsErrorSaveNoParticulars', 'Please fill the total amount in particulars or client has empty particulars!');
                    return url()->previous();
                }

            } else {
                // Create
                
                // Add a default value for transaction status
                $data['transaction_status_id'] = TransactionStatus::SETUP;
                    
                $data['all_total_debits'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_debits']));
                $data['all_total_credits'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_credits']));

                if(!empty($this->particulars) && floatval(preg_replace('/[^\d.]/', '', $this->all_total_paid)) > 0 ){
                    if($this->receipt_type_id == ReceiptType::AR){

                        $createTransactionId = $this->transactionService->transactionSummary($data, $this->serviceInvoiceId);
            
                        $this->transactionService->transactionData($this->serviceInvoiceId, $this->listItems, $this->oldItems, $data, $createTransactionId);        
                    
                        // Add to transaction_particulars
                        foreach ($this->particulars as $key => $value) {
                            if( (floatval(preg_replace('/[^\d.]/', '', $value['total_paid'])) != null && floatval(preg_replace('/[^\d.]/', '', $value['total_paid']) > 0)) && (floatval(preg_replace('/[^\d.]/', '', $value['this_payment']) != null && floatval(preg_replace('/[^\d.]/', '', $value['this_payment']) > 0))) ){
                                TransactionParticular::create([
                                    'transaction_summary_invoice_id' => $value['transaction_id'],
                                    'transaction_summary_receipt_id' => $createTransactionId,
                                    'total_paid' => floatval(preg_replace('/[^\d.]/', '', $value['total_paid'])),
                                    'this_payment' => floatval(preg_replace('/[^\d.]/', '', $value['this_payment'])),
                                ]);
                            }
                        }

                        // Add to ar_transactions
                        ArTransaction::create([
                            'transaction_summary_id' => $createTransactionId,
                        ]);
                        
                    }elseif($this->receipt_type_id == ReceiptType::OR){
                            $createTransactionId = $this->transactionService->transactionSummary($data, $this->serviceInvoiceId);
                
                            $this->transactionService->transactionData($this->serviceInvoiceId, $this->listItems, $this->oldItems, $data, $createTransactionId);        
                        
                            // Add to transaction_particulars
                            foreach ($this->particulars as $key => $value) {
                                if( (floatval(preg_replace('/[^\d.]/', '', $value['total_paid'])) != null && floatval(preg_replace('/[^\d.]/', '', $value['total_paid']) > 0)) && (floatval(preg_replace('/[^\d.]/', '', $value['this_payment']) != null && floatval(preg_replace('/[^\d.]/', '', $value['this_payment']) > 0))) ){
                                    TransactionParticular::create([
                                        'transaction_summary_invoice_id' => $value['transaction_id'],
                                        'transaction_summary_receipt_id' => $createTransactionId,
                                        'total_paid' => floatval(preg_replace('/[^\d.]/', '', $value['total_paid'])),
                                        'this_payment' => floatval(preg_replace('/[^\d.]/', '', $value['this_payment'])),
                                    ]);
                                }
                            }

                            // Add to or_transaction
                            OrTransaction::create([
                                'transaction_summary_id' => $createTransactionId,
                            ]);
                    }
                }else{
                    Session::flash('receiptPaymentsErrorSaveNoParticulars', 'Please fill the total amount in particulars or client has empty particulars!');
                    return url()->previous();
                }

            }

        } catch (\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
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
        $this->emit('closeServiceInvoiceModal');
        return redirect()->to('/receipts-payments');
    }

    public function transactionConfirmServiceInvoice($serviceInvoiceId, $data)
    {
        
        if($data == "posted"){

            // get the transaction summary invoice in transaction particulars
            $prtclrs = TransactionParticular::with('transactionSummaryReceipt')->where('transaction_summary_receipt_id', $serviceInvoiceId)->get();

            // 
            $id = [];
            foreach ($prtclrs as $key => $value) {
                $id[] = $value['transaction_summary_invoice_id']; 
            }
            
            // get the transaction summary invoice in transaction particulars
            $prtclrs = TransactionParticular::with('transactionSummaryInvoice.jobOrder')->whereIn('transaction_summary_invoice_id', $id)->get();

            $paids = [];
            foreach ($prtclrs as $key => $value) {
                $paids[$key] = [
                    'transaction_id' => $value->transaction_summary_invoice_id, //new
                    'receipt_id' => $value->transaction_summary_receipt_id, //new
                    'invoice_no' => $value->transactionSummaryInvoice->receipt_no, //new
                    'ref_date' => date('Y-m-d', strtotime($value->transactionSummaryInvoice->jobOrder->date)),
                    'terms' => $value->transactionSummaryInvoice->jobOrder->term,
                    'inv_amount' => number_format($value->transactionSummaryInvoice->jobOrder->overall_total, 2),
                    'total_paid' => $value->total_paid,
                    'this_payment' => $value->this_payment,
                ];
            }
        
            $this->dispatchBrowserEvent('swal:confirmServiceInvoiceTransaction', [
                'title' => 'Are you sure?',
                'text' => "You won't be able to revert this!",
                'icon' => 'warning',
                'showCancelButton' => true,
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'confirmButtonText' => 'Yes, accept it!',
                'id' => $serviceInvoiceId,
                'data' => $data,
                'particular' => $paids,
            ]);

        }else{
            $this->dispatchBrowserEvent('swal:confirmServiceInvoiceTransaction', [
                'title' => 'Are you sure?',
                'text' => "You won't be able to revert this!",
                'icon' => 'warning',
                'showCancelButton' => true,
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'confirmButtonText' => 'Yes, accept it!',
                'id' => $serviceInvoiceId,
                'data' => $data
            ]);
        }
    }

    //Update the transaction status id
    public function deleteServiceInvoice($serviceInvoiceId, $data)
    {
        if($data == "posted"){
            TransactionSummary::where('id',$serviceInvoiceId)->update([
                'transaction_status_id' => TransactionStatus::POSTED,
            ]);
        }elseif($data == "reversed"){
            TransactionSummary::where('id',$serviceInvoiceId)->update([
                'transaction_status_id' => TransactionStatus::REVERSED,
            ]);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeServiceInvoiceModal');
    }

    public function deleteItem($index){
        unset($this->listItems[$index]);
        $this->listItems = array_values($this->listItems);

        $this->updated();
    }

    public function addBank()
    {
        $this->emit('resetInputFieldsClient');
        $this->emit('openBankModal');
    }

    public function render()
    {
        $report_data = TransactionSummary::with('jobOrder.clientProfile', 'receiptFor', 'fors', 'getCollect', 'getPaymentType', 'getCustomerBank')->where('id', $this->serviceInvoiceId)->get();  
        $items = TransactionData::with('chartOfAccounts')->where('transaction_summary_id', $this->serviceInvoiceId)->orderBy('transaction_arrangement')->get();

        // get the transaction summary invoice in transaction particulars
        $prtclrs = TransactionParticular::with('transactionSummaryReceipt')->where('transaction_summary_receipt_id', $this->serviceInvoiceId)->get(); 
        $id = [];
        foreach ($prtclrs as $key => $value) {
            $id[] = $value['transaction_summary_invoice_id']; 
        }
        
        // get the transaction summary invoice in transaction particulars
        $prtclrs = TransactionParticular::with('transactionSummaryInvoice.jobOrder')->whereIn('transaction_summary_invoice_id', $id)->get();
        // dd($prtclrs);
        return view('livewire.billing.receipts-payments-form', [
            'receipt_types' => ReceiptTypes::all(),
            'accout_numbers' => ChartOfAccounts::all(),
            // 'job_orders' => JobOrder::where('status', 9)->where('payment_status_id', 13)->get(),
            'job_orders' => JobOrder::where('overall_total', '!=' , null)->where('payment_status_id', 13)->get(),
            'receipt_fors' => ReceiptFor::all(),
            'fors' => TransactionFor::all(),
            'banks' => Bank::with('chartOfAccounts')->whereIn('id', [1,2])->get(),
            'client_banks' => Bank::with('chartOfAccounts')->get(),
            'transaction_types' => TransactionTypes::all(),
            'report_data' => $report_data,
            'items' => $items,
            'prtclrs' => $prtclrs,
            'clients' => ClientProfile::where('status_id', Status::ACTIVE)->get(),
            'collects' => Collect::all(),
            'payments' => PaymentType::where('id', '!=', 2)->get(),
        ]);
    }
}
