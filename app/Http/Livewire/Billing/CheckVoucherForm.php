<?php

namespace App\Http\Livewire\Billing;

use App\Enums\Status;
use App\Enums\TransactionStatus;
use App\Models\Bank;
use App\Models\BillingSupplier;
use App\Models\ChartOfAccounts;
use App\Models\CheckVoucher;
use App\Models\CheckVoucherData;
use App\Models\Supplier;
use App\Models\TransactionFor;
use App\Models\VoucherType;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;

class CheckVoucherForm extends Component
{

    public $date, $voucher_type_id, $bank_id, $for_id, $supplier_id, $gl_account, $summary_explanation, $particulars, $checkVoucherId, $all_total_debits, $all_total_credits, $check_no, $check_date, $amount, $transaction_status_id, $viewCheckVoucherId;
    public $listItems = [];

    protected $listeners = [
        'refreshParentCheckVoucher' => '$refresh',
        'checkVoucherId',
        'checkVoucherDate',
        'postCheckVoucher',
        'reverseCheckVoucher',
        'viewCheckVoucherId',
        'resetInputFields',
        'selectedChart',
    ];

    public function selectedChart($id, $index)
    {
        $chartOfAccount = ChartOfAccounts::find($id);

        $this->listItems[$index] = [
            'accnt_no' => $id,
            'account_title' => $chartOfAccount->account_desc,
            'debits' =>  "0.00",
            'credits' =>  "0.00",
        ];
        $this->updated();
    }

    public function checkVoucherDate($date)
    {
        $this->date = date('Y-m-d', strtotime($date));
        $this->check_date = date('Y-m-d', strtotime($date));
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
        $this->addItem();
    }

    public function addItem()
    {
        $this->listItems[] = [
            'accnt_no' =>'',
            'account_title' => '',
            'debits' =>  '',
            'credits' =>  '',
        ];
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function printCheckVoucher($checkVoucherId)
    {
        $voucher = CheckVoucher::with('getCheckVoucherData.getChartOfAccounts', 'getSupplierId', 'getBankId')->find($checkVoucherId);

        $pdf  = PDF::loadView('livewire.prints.check-voucher', ['voucher' => $voucher])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"check-voucher.pdf"
        );    
    }

    public function postConfirmCheckVoucher($checkVoucherId)
    {
        $this->dispatchBrowserEvent('swal:postConfirmCheckVoucher', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, update it!',
            'id' => $checkVoucherId
        ]);
    }

    public function postCheckVoucher($checkVoucherId)
    {
        $checkVoucher = CheckVoucher::find($checkVoucherId);
        $checkVoucher->update([
            'transaction_status_id' => TransactionStatus::POSTED
        ]);

        $this->emit('refreshParent');
        $this->emit('closeCheckVoucherModal');
        return redirect()->to('/check-voucher');
    }

    public function reverseConfirmCheckVoucher($checkVoucherId)
    {
        $this->dispatchBrowserEvent('swal:reverseConfirmCheckVoucher', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, update it!',
            'id' => $checkVoucherId
        ]);
    }

    public function reverseCheckVoucher($checkVoucherId)
    {
        // CheckVoucher::where('id', $checkVoucherId)->update([
        //     'transaction_status_id' => TransactionStatus::REVERSED
        // ]);
        $checkVoucher = CheckVoucher::find($checkVoucherId);
        $checkVoucher->update([
            'transaction_status_id' => TransactionStatus::REVERSED
        ]);

        $this->emit('refreshParent');
        $this->emit('closeCheckVoucherModal');
        return redirect()->to('/check-voucher');
    }

    public function viewCheckVoucherId($viewCheckVoucherId)
    {
        $this->checkVoucherId = null;
        $this->viewCheckVoucherId = $viewCheckVoucherId;
        $voucher = CheckVoucher::with('getCheckVoucherData.getChartOfAccounts')->find($viewCheckVoucherId);

        $this->date = $voucher->date;
        $this->voucher_type_id = $voucher->voucher_type_id;
        $this->bank_id = $voucher->bank_id;
        $this->for_id = $voucher->for_id;
        $this->supplier_id = $voucher->supplier_id;
        $this->gl_account = $voucher->gl_account;
        $this->summary_explanation = $voucher->summary_explanation;
        $this->particulars = $voucher->particulars;
        $this->check_no = $voucher->check_no;
        $this->check_date = $voucher->check_date;
        $this->amount = number_format($voucher->amount, 2);
        $this->transaction_status_id = $voucher->transaction_status_id;

        $this->updatedBankId($this->bank_id);

        foreach ($voucher->getCheckVoucherData as $key => $value) {
            $this->listItems[$key] = [
                'accnt_no' => $value->account_number,
                'account_title' => $value->getChartOfAccounts->account_desc,
                'debits' =>  $value->debits,
                'credits' =>  $value->credits,
            ];
        }

        $this->updated();
    }

    // edit
    public function checkVoucherId($checkVoucherId)
    {
        $this->viewCheckVoucherId = null;
        $this->listItems = [];
        $this->checkVoucherId = $checkVoucherId;
        $voucher = CheckVoucher::with('getCheckVoucherData.getChartOfAccounts')->find($checkVoucherId);

        $this->date = $voucher->date;
        $this->voucher_type_id = $voucher->voucher_type_id;
        $this->bank_id = $voucher->bank_id;
        $this->for_id = $voucher->for_id;
        $this->supplier_id = $voucher->supplier_id;
        $this->gl_account = $voucher->gl_account;
        $this->summary_explanation = $voucher->summary_explanation;
        $this->particulars = $voucher->particulars;
        $this->check_no = $voucher->check_no;
        $this->check_date = $voucher->check_date;
        $this->amount = number_format($voucher->amount, 2);
        $this->transaction_status_id = $voucher->transaction_status_id;

        $this->updatedBankId($this->bank_id);
        // $this->updated();

        foreach ($voucher->getCheckVoucherData as $key => $value) {
            $this->dispatchBrowserEvent('reApplySelect2');
            $this->listItems[$key] = [
                'accnt_no' => $value->account_number,
                'account_title' => $value->getChartOfAccounts->account_desc,
                'debits' =>  $value->debits,
                'credits' =>  $value->credits,
            ];
        }

        $this->updated();
    }

    public function updatedSupplierId($id)
    {
        $this->listItems = [];
        $this->updated();
        $supplier = BillingSupplier::where('id', $id)->first();
        $journal = unserialize($supplier->journalize);
        
        if(!empty($journal)){
            foreach ($journal as $key => $value) {
                $chart_of_accounts = ChartOfAccounts::where('id', $value)->first();
                $this->dispatchBrowserEvent('reApplySelect2');
                $this->listItems[$key] = [
                    'accnt_no' => $chart_of_accounts->id,
                    'account_title' => $chart_of_accounts->account_desc,
                    'debits' =>  '',
                    'credits' =>  '',
                ];
            }
        }else{
            $this->addItem();
        }
    }

    public function updatedBankId($id)
    {
        if($id == 1){
            $this->for_id = 2;

            if(!empty($id)){
                $bank = Bank::with('chartOfAccounts')->where('id',$id)->get();
    
                foreach ($bank as $accounts) {
                    if($accounts->chartOfAccounts != null){
                        $this->gl_account = $accounts->chartOfAccounts->account_code . " = " .$accounts->chartOfAccounts->account_desc;
                    }else{
                        $this->gl_account = "";
                    }
                }
    
            }else{
                $this->gl_account = "";
            }
        }elseif($id == 2){
            $this->for_id = 1;

            if(!empty($id)){
                $bank = Bank::with('chartOfAccounts')->where('id',$id)->get();
    
                foreach ($bank as $accounts) {
                    if($accounts->chartOfAccounts != null){
                        $this->gl_account = $accounts->chartOfAccounts->account_code . " = " .$accounts->chartOfAccounts->account_desc;
                    }else{
                        $this->gl_account = "";
                    }
                }
    
            }else{
                $this->gl_account = "";
            }
        }else{
            $this->for_id = '';
            $this->gl_account = '';
        }
    }

    public function updatedForId($id)
    {
        if($id == 1){
            $this->bank_id = 2;

            if(!empty($id)){
                $bank = Bank::with('chartOfAccounts')->where('id',$this->bank_id)->get();
    
                foreach ($bank as $accounts) {
                    if($accounts->chartOfAccounts != null){
                        $this->gl_account = $accounts->chartOfAccounts->account_code . " = " .$accounts->chartOfAccounts->account_desc;
                    }else{
                        $this->gl_account = "";
                    }
                }
    
            }else{
                $this->gl_account = "";
            }
        }elseif($id == 2){
            $this->bank_id = 1;

            if(!empty($id)){
                $bank = Bank::with('chartOfAccounts')->where('id',$this->bank_id)->get();
    
                foreach ($bank as $accounts) {
                    if($accounts->chartOfAccounts != null){
                        $this->gl_account = $accounts->chartOfAccounts->account_code . " = " .$accounts->chartOfAccounts->account_desc;
                    }else{
                        $this->gl_account = "";
                    }
                }
    
            }else{
                $this->gl_account = "";
            }
        }else{
            $this->bank_id = '';
            $this->gl_account = '';
        }
    }

    public function updatedAmount($amount)
    {
        $amount = floatval(preg_replace('/[^\d.]/', '', $amount));
        $this->amount = number_format($amount, 2);

        if($this->supplier_id != null){
            $supplier = BillingSupplier::where('id', $this->supplier_id)->first();

            if(preg_match("/PLDT/i", $supplier->name)){
                foreach ($this->listItems as $key => $value) {
                    if($key == 0){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format( (($amount / 1.12) * 0.12) - $amount, 2);
                    }elseif ($key == 1){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format(($amount / 1.12) * 0.12, 2);
                    }elseif ($key == 2){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['credits'] = number_format($amount, 2);
                    }
                }
            }
            
            if(preg_match("/SMART/i", $supplier->name)){
                foreach ($this->listItems as $key => $value) {
                    if($key == 0){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format( (($amount / 1.12) * 0.12) - $amount, 2);
                    }elseif ($key == 1){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format(($amount / 1.12) * 0.12, 2);
                    }elseif ($key == 2){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['credits'] = number_format($amount, 2);
                    }
                }
            }
            
            if(preg_match("/GLOBE/i", $supplier->name)){
                foreach ($this->listItems as $key => $value) {
                    if($key == 0){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format( (($amount / 1.12) * 0.12) - $amount, 2);
                    }elseif ($key == 1){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format(($amount / 1.12) * 0.12, 2);
                    }elseif ($key == 2){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['credits'] = number_format($amount, 2);
                    }
                }
            }
            
            if(preg_match("/NORECO/i", $supplier->name)){
                foreach ($this->listItems as $key => $value) {
                    if($key == 0){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format( (($amount / 1.12) * 0.12) - $amount, 2);
                    }elseif ($key == 1){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format(($amount / 1.12) * 0.12, 2);
                    }elseif ($key == 2){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['credits'] = number_format($amount, 2);
                    }
                }
            }
            
            if(preg_match("/DY/i", $supplier->name)){
                foreach ($this->listItems as $key => $value) {
                    if($key == 0){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format($amount, 2);
                    }elseif ($key == 1){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['credits'] = number_format($amount, 2);
                    }
                }
            }
            
            if(preg_match("/METRO DUMAGUETE WATER/i", $supplier->name)){
                foreach ($this->listItems as $key => $value) {
                    if($key == 0){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['debits'] = number_format($amount, 2);
                    }elseif ($key == 1){
                        $this->dispatchBrowserEvent('reApplySelect2');
                        $this->listItems[$key]['credits'] = number_format($amount, 2);
                    }
                }
            }
            
            if($this->summary_explanation != null){
                if(preg_match("/MECHANIC INCENTIVE/i", $this->summary_explanation)){
                    foreach ($this->listItems as $key => $value) {
                        if($key == 0){
                            $this->dispatchBrowserEvent('reApplySelect2');
                            $this->listItems[$key]['debits'] = number_format($amount, 2);
                        }elseif ($key == 1){
                            $this->dispatchBrowserEvent('reApplySelect2');
                            $this->listItems[$key]['credits'] = number_format($amount, 2);
                        }
                    }
                }
            }

            $this->updated();
        }
    }

    public function updatedListItems($id, $value)
    {
        if(explode('.', $value)[1] == "accnt_no"){
            $this->getChartOfAccounts($id, explode('.', $value)[0]);
            
        }
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
    }

    public function addSupplier()
    {
        $this->emit('resetInputFieldsClient');
        $this->emit('openSupplierModal');
    }

    public function store()
    {
            $data = $this->validate([
                'date' => 'required',
                'voucher_type_id' => 'required',
                'bank_id' => 'required',
                'for_id' => 'required',
                'supplier_id' => 'required',
                'summary_explanation' => 'required',
                'particulars' => 'required',
                'amount' => 'required',
                'check_no' => 'nullable',
                'check_date' => 'required',
            ]);

            $this->validate([
                'all_total_debits' => 'required|same:amount|same:all_total_credits',
                'all_total_credits' => 'required',
            ]);

            try {

                if ($this->checkVoucherId) {
                    // Update
                    
                    // Convert the string all total debits & all total credits into float bfore to save
                    for ($i=0; $i < sizeof($data); $i++) {
                        $data['amount'] = floatval(preg_replace('/[^\d.]/', '', $data['amount']));
                    }

                    // Update the purchase order to the latest data
                    // CheckVoucher::where('id', $this->checkVoucherId)->update($data);
                    $checkVoucher = CheckVoucher::find($this->checkVoucherId);
                    $checkVoucher->update($data);
                    

                    // Convert the string debits and credits into float bfore to save
                    foreach ($this->listItems as $key => $value) {
                        if(!empty($this->listItems[$key]['debits'])){
                            $this->listItems[$key]['debits'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['debits']));
                        }else{
                            $this->listItems[$key]['debits'] = 0.00;
                        }
                        if(!empty($this->listItems[$key]['credits'])){
                            $this->listItems[$key]['credits'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['credits']));
                        }else{
                            $this->listItems[$key]['credits'] = 0.00;
                        }
                    }

                    // Update product to true in update product column
                    foreach ($this->listItems as $key => $value) {
                        CheckVoucherData::updateOrCreate([
                        'check_voucher_id' => $this->checkVoucherId,
                        'account_number' => (int) $this->listItems[$key]['accnt_no']
                        ], [
                            'check_voucher_id' => $this->checkVoucherId,
                            'account_number' => (int) $this->listItems[$key]['accnt_no'],
                            'account_title' => $this->listItems[$key]['account_title'],
                            'update_check_voucher' => 1,
                            'check_voucher_arrangement' => $key,
                            'debits' => $this->listItems[$key]['debits'],
                            'credits' => $this->listItems[$key]['credits'],
                        ]);
                    }

                    // Delete product that is false
                    foreach ($this->listItems as $key => $value) {
                        CheckVoucherData::where('check_voucher_id', '=', $this->checkVoucherId)
                        ->where('update_check_voucher', '=', 0)
                        ->delete();
                    }

                    // Return back all transaction back to false
                    foreach ($this->listItems as $key => $value) {
                        CheckVoucherData::where('check_voucher_id', '=', $this->checkVoucherId)
                        ->where('account_number', '=', (int) $this->listItems[$key]['accnt_no'])
                        ->update([
                            'update_check_voucher' => 0,
                        ]);
                    }
    
                } else {
                    // Create
                    
                    // Add a default value for transaction status
                    $data['transaction_status_id'] = TransactionStatus::SETUP;

                    // Convert the string all total debits & all total credits into float bfore to save
                    for ($i=0; $i < sizeof($data); $i++) {
                        $data['amount'] = floatval(preg_replace('/[^\d.]/', '', $data['amount']));
                    }

                    $check_voucher = CheckVoucher::create($data);

                    // Convert the string debits and credits into float bfore to save
                    foreach ($this->listItems as $key => $value) {
                        if(!empty($this->listItems[$key]['debits'])){
                            $this->listItems[$key]['debits'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['debits']));
                        }else{
                            $this->listItems[$key]['debits'] = 0.00;
                        }
                        if(!empty($this->listItems[$key]['credits'])){
                            $this->listItems[$key]['credits'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$key]['credits']));
                        }else{
                            $this->listItems[$key]['credits'] = 0.00;
                        }
                    }

                    // Update product to true in update product column
                    foreach ($this->listItems as $key => $value) {
                        CheckVoucherData::create([
                            'check_voucher_id' => $check_voucher->id,
                            'account_number' => (int) $value['accnt_no'],
                            'account_title' => $value['account_title'],
                            'check_voucher_arrangement' => $key,
                            'debits' => $value['debits'],
                            'credits' => $value['credits'],
                        ]);
                    }
    
                }
    
            } catch (\Exception $e) {
                dd($e);
                return back();
                $action = 'error';
                $this->emit('flashAction',$action,$data);
            }

            if ($this->checkVoucherId) {
                $action = 'edit';
                $message = 'Check Voucher Successfully Updated';
                // dd($action);
                $this->emit('flashAction', $action, $message);
            } else {
                $action = 'store';
                $message = 'Check Voucher Successfully Saved';
                // dd($action);
                $this->emit('flashAction', $action, $message);
            }
    
            $this->resetInputFields();
            $this->emit('refreshParent');
            $this->emit('closeCheckVoucherModal');
            return redirect()->to('/check-voucher');
    }

    public function mount()
    {
        $this->addItem();
    }

    public function deleteItem($index)
    {
        unset($this->listItems[$index]);
        $this->listItems = array_values($this->listItems);
        $this->updated();
    }

    public function render()
    {
        return view('livewire.billing.check-voucher-form', [
            'voucher_type' => VoucherType::all(),
            'banks' => Bank::with('chartOfAccounts')->whereIn('id', [1,2])->get(),
            'fors' => TransactionFor::all(),
            'suppliers' => BillingSupplier::where('status_id', Status::ACTIVE)->get(),
            'accout_numbers' => ChartOfAccounts::all(),
        ]);
    }
}
