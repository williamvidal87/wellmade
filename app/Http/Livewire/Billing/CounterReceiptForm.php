<?php

namespace App\Http\Livewire\Billing;

use App\Enums\Status;
use App\Enums\TransactionStatus as EnumsTransactionStatus;
use App\Models\ClientProfile;
use App\Models\CounterReceipt;
use App\Models\CounterReceiptData;
use App\Models\TransactionStatus;
use App\Models\TransactionSummary;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\Component;

class CounterReceiptForm extends Component
{

    public $listItems = [];
    public $client_id, $counterReceiptId, $date;
    public $transac = [];
    public $payment = [];
    public $entries, $total = 0; 
    public $paid = 0; 
    public $balance = 0;
    public $payCrId, $transaction_status_id, $viewPayCrId;
    public $listUsedInvoices = [];

    protected $listeners = [
        'counterReceiptDate',
        'resetInputFields',
        'counterReceiptId',
        'payCounterReceiptId',
        'postCounterReceipt',
        'viewCounterReceiptId',
        'reverseCounterReceipt',
        'selectedClient',
    ];

    public function selectedClient($id)
    {
        if($id){
            $this->client_id = $id;
            $this->listItems = [];
            $this->addItem();

            if($this->payCrId || $this->viewPayCrId || $this->counterReceiptId){
                $this->transac = TransactionSummary::where('transaction_type_id', 2)
                ->whereIn('transaction_status_id', [2,3])
                ->whereHas('jobOrder', function ($query) use($id) {
                    return $query->where('customer_id', '=', $id);
                })->get();
            }elseif(!$this->counterReceiptId){
                $this->transac = TransactionSummary::where('transaction_type_id', 2)
                ->whereIn('transaction_status_id', [2,3])
                ->where('status_id', Status::UNPAID)
                ->whereHas('jobOrder', function ($query) use($id) {
                    return $query->where('customer_id', '=', $id);
                })->get();
            }
            
            $this->payment = TransactionSummary::where('transaction_type_id', 1)
                    ->where('transaction_status_id', 2)
                    ->where('client_id', $id)
                    ->get();
    
            $this->listUsedInvoices = CounterReceiptData::with('getTransactionSummary', 'getCounterReceipt')
                    //where status_id 
                    ->whereHas('getCounterReceipt', function($query){
                        $query->where('client_id', $this->client_id)->where('transaction_status_id', '!=', EnumsTransactionStatus::REVERSED);
                    })->pluck('transaction_summary_cr_id');
        }
    }

    public function hydrate(){
        $this->emit('select2');
    }

    public function printCounterReceipt($counterReceiptId)
    {
        $counter_receipt_data = CounterReceipt::whereHas('getCounterReceiptData', function ($query) use ($counterReceiptId) {
                $query->where('cr_id', $counterReceiptId);
                $query->where('status_id', '=', Status::UNPAID);
            })
            ->with(['getCounterReceiptData' => function ($query) use($counterReceiptId) {
                $query->where('cr_id', $counterReceiptId);
                $query->where('status_id', '=', Status::UNPAID);
            }, 'getCounterReceiptData.getTransactionSummary.jobOrder', 'getClient'])
            // ->where('id', $counterReceiptId)
            // ->with('getCounterReceiptData.getTransactionSummary.jobOrder', 'getClient')
            ->first();
            // dd($counter_receipt_data);
            // ->whereHas('jobOrder', function ($query) use($id) {
            //     return $query->where('customer_id', '=', $id);
            // })->get();
        $pdf  = PDF::loadView('livewire.prints.counter-receipt', ['counter_receipt_data' => $counter_receipt_data])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"counter-receipt.pdf"
        );
    }

    public function reverseConfirmCounterReceipt($counterReceiptId)
    {
        $this->dispatchBrowserEvent('swal:reverseConfirmCounterReceipt', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, update it!',
            'id' => $counterReceiptId
        ]);
    }

    public function reverseCounterReceipt($counterReceiptId)
    {
        $transaction = CounterReceipt::find($counterReceiptId);
        $transaction->update([
            'transaction_status_id' => EnumsTransactionStatus::REVERSED,
        ]);

        $this->emit('refreshParent');
        $this->emit('closeCounterReceiptModal');
    }

    public function viewCounterReceiptId($viewPayCrId)
    {
        $this->payCrId = null;
        $this->counterReceiptId = null;
        $this->viewPayCrId = $viewPayCrId;

        $counterReceipt = CounterReceipt::find($viewPayCrId);
        $this->date = $counterReceipt->date;
        $this->client_id = $counterReceipt->client_id;
        $this->entries = $counterReceipt->entries;
        $this->total = $counterReceipt->total;
        $this->paid = $counterReceipt->paid;
        $this->transaction_status_id = $counterReceipt->transaction_status_id;

        // Balance
        $this->balance = number_format($this->total - $this->paid, 2);

        // Get the counter receipt data
        $receipts = CounterReceiptData::with('getTransactionSummary.jobOrder.clientProfile.forCSA')->where('cr_id', $viewPayCrId)->get();
        $this->selectedClient($this->client_id);

        foreach ($receipts as $key => $value) {
            $this->listItems[$key] = [
                'invoice_no' => $value->getTransactionSummary->id,
                'ref_date' => $value->getTransactionSummary->date,
                'csa' => $value->getTransactionSummary->jobOrder->clientProfile->forCSA->csa_type,
                'net_amount' => number_format($value->getTransactionSummary->jobOrder->overall_total, 2),
                'status_id' => $value->getStatus->id ?? '',
                'payments' => $value->transaction_payment_cr_id,
            ];
        }


        $this->updated();
    }

    public function payCounterReceiptId($payCrId)
    {
        $this->payCrId = $payCrId;
        $this->counterReceiptId = null;
        $this->viewPayCrId = null;

        $counterReceipt = CounterReceipt::find($payCrId);
        $this->date = $counterReceipt->date;
        $this->client_id = $counterReceipt->client_id;
        $this->entries = $counterReceipt->entries;
        $this->total = $counterReceipt->total;
        $this->paid = $counterReceipt->paid;
        $this->transaction_status_id = $counterReceipt->transaction_status_id;

        // Balance
        $this->balance = number_format($this->total - $this->paid, 2);

        // Get the counter receipt data
        $receipts = CounterReceiptData::with('getTransactionSummary.jobOrder.clientProfile.forCSA')->where('cr_id', $payCrId)->get();
        $this->selectedClient($this->client_id);

        foreach ($receipts as $key => $value) {
            $this->listItems[$key] = [
                'invoice_no' => $value->getTransactionSummary->id,
                'ref_date' => $value->getTransactionSummary->date,
                'csa' => $value->getTransactionSummary->jobOrder->clientProfile->forCSA->csa_type,
                'net_amount' => number_format($value->getTransactionSummary->jobOrder->overall_total, 2),
                'status_id' => $value->getStatus->id ?? '',
                'payments' => $value->transaction_payment_cr_id,
            ];
        }

        $this->updated();
    }

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->addItem();
    }

    public function postConfirmCounterReceipt($counterReceiptId)
    {
        $this->dispatchBrowserEvent('swal:postConfirmCounterReceipt', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, update it!',
            'id' => $counterReceiptId
        ]);
    }

    public function postCounterReceipt($counterReceiptId)
    {
        $transaction = CounterReceipt::find($counterReceiptId);
        $transaction->update([
            'transaction_status_id' => EnumsTransactionStatus::POSTED,
        ]);

        $this->emit('refreshParent');
        $this->emit('closeCounterReceiptModal');
    }

    // edit
    public function counterReceiptId($counterReceiptId)
    {
        // change the payCrId to null
        $this->payCrId = null;
        $this->viewPayCrId = null;
        $this->counterReceiptId = $counterReceiptId;
        $counterReceipt = CounterReceipt::find($counterReceiptId);
        $this->date = $counterReceipt->date;
        $this->client_id = $counterReceipt->client_id;
        $this->entries = $counterReceipt->entries;
        $this->total = $counterReceipt->total;
        $this->paid = $counterReceipt->paid;
        $this->transaction_status_id = $counterReceipt->transaction_status_id;

        // Balance
        $this->balance = number_format($this->total - $this->paid, 2);

        // Get the counter receipt data
        $receipts = CounterReceiptData::with('getTransactionSummary.jobOrder.clientProfile.forCSA')->where('cr_id', $counterReceiptId)->get();
        $this->selectedClient($this->client_id);

        foreach ($receipts as $key => $value) {
            if($value->transaction_payment_cr_id){
                $this->listItems[$key] = [
                    'invoice_no' => $value->getTransactionSummary->id,
                    'ref_date' => $value->getTransactionSummary->date,
                    'csa' => $value->getTransactionSummary->jobOrder->clientProfile->forCSA->csa_type ?? '',
                    'net_amount' => number_format($value->getTransactionSummary->jobOrder->overall_total ?? 0 , 2),
                    'status_id' => $value->getStatus->id ?? '',
                    'payments' => $value->getTransactionPayment->id,
                ];
            }else{
                $this->listItems[$key] = [
                    'invoice_no' => $value->getTransactionSummary->id,
                    'ref_date' => $value->getTransactionSummary->date,
                    'csa' => $value->getTransactionSummary->jobOrder->clientProfile->forCSA->csa_type,
                    'net_amount' => number_format($value->getTransactionSummary->jobOrder->overall_total, 2),
                    'status_id' => $value->getStatus->id ?? '',
                    'payments' => '',
                ];
            }

        }


        $this->updated();
    }

    public function counterReceiptDate($date)
    {
        $this->date = date('Y-m-d', strtotime($date));
    }

    public function updatedListItems($id, $name)
    {
        if (explode('.', $name)[1] == "invoice_no") {
            $this->entries = 0;
            $this->getSpecificProduct($id, explode('.', $name)[0]);
        }
    }

    public function updated()
    {
        $this->entries = 0;
        $this->paid = 0;
        

        for ($i = 0; $i < sizeof($this->listItems); $i++) {
            if (!empty($this->listItems[$i]['net_amount'])) {
                $this->listItems[$i]['net_amount'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['net_amount']));
                $this->entries++;
            }

            if($this->listItems[$i]['payments'] != null){
                $transaction = CounterReceiptData::with('getTransactionSummary')->where('transaction_summary_cr_id', $this->listItems[$i]['invoice_no'])->where('cr_id', $this->payCrId ?? $this->counterReceiptId)->first();

                if($transaction != null){
                    $this->paid +=  $transaction->getTransactionSummary->all_total_debits;
                }else{
                    $transaction = TransactionSummary::where('id', $this->listItems[$i]['payments'])->first();
                    
                    $this->paid += $transaction->all_total_debits;
                }

            }
        }

        $total = 0;
        foreach ($this->listItems as $key => $item) {
            $this->listItems[$key]['net_amount'] = empty($item['net_amount']) ? 0.00 : (is_numeric($item['net_amount']) ? $item['net_amount'] : 0.00);

            $total += round($this->listItems[$key]['net_amount'], 2);
        }
        $this->total = $total;

        $this->balance = $this->total - $this->paid;

        $this->total = number_format($this->total, 2);
        $this->paid = number_format($this->paid, 2);
        $this->balance = number_format($this->balance, 2);

        for ($i = 0; $i < sizeof($this->listItems); $i++) {
            if ($this->listItems[$i]['net_amount'] == 0.00) {
                $this->listItems[$i]['net_amount'] = "0.00";
            } else {
                $this->listItems[$i]['net_amount'] = number_format((float) $this->listItems[$i]['net_amount'], 2);
            }
        }
    }

    public function getSpecificProduct($idProduct, $idList)
    {
        if (!empty($idProduct)) {

            // Transaction
            $transac = TransactionSummary::with('jobOrder.clientProfile.forCSA')->where('id', $idProduct)->first();
            $this->listItems[(int) $idList] = [
                'invoice_no' => $transac->id,
                'ref_date' => $transac->date,
                'csa' => $transac->jobOrder->clientProfile->forCSA->csa_type,
                'net_amount' => number_format($transac->jobOrder->overall_total, 2),
                'payments' => '',
            ];

            $this->updated();
        } else {

            $this->listItems[(int) $idList] = [
                'invoice_no' => '',
                'ref_date' => '',
                'csa' => '',
                'net_amount' => '',
                'payments' => '',
            ];

            $this->updated();
        }

    }

    public function store()
    {
        $data = $this->validate([
            'date' => 'required',
            'client_id' => 'required',
            'entries' => 'required',
            'paid' => 'nullable',
            'total' => 'nullable',
        ]);

        try
		{
            if($this->counterReceiptId){
                // Update Or Create functionality
                // Convert the string debits and credits into float bfore to save
                if(!empty($data['paid'])){
                    $data['paid'] = floatval(preg_replace('/[^\d.]/', '', $data['paid']));
                }else{
                    $data['paid'] = 0.00;
                }
                if(!empty($data['total'])){
                    $data['total'] = floatval(preg_replace('/[^\d.]/', '', $data['total']));
                }else{
                    $data['total'] = 0.00;
                }

                CounterReceipt::find($this->counterReceiptId)->update($data);

                // Update product to true in update product column
                foreach ($this->listItems as $key => $value) {
                    CounterReceiptData::updateOrCreate([
                    'cr_id' => $this->counterReceiptId,
                    'transaction_summary_cr_id' => (int) $this->listItems[$key]['invoice_no']
                    ], [
                        'cr_id' => $this->counterReceiptId,
                        'transaction_summary_cr_id' => (int) $this->listItems[$key]['invoice_no'],
                        'update_counter_receipt' => 1,
                        'counter_receipt_arrangement' => $key,
                    ]);
                }

                // Delete product that is false
                foreach ($this->listItems as $key => $value) {
                    CounterReceiptData::where('cr_id', '=', $this->counterReceiptId)
                    ->where('update_counter_receipt', '=', 0)
                    ->delete();
                }

                // Return back all transaction back to false
                foreach ($this->listItems as $key => $value) {
                    CounterReceiptData::where('cr_id', '=', $this->counterReceiptId)
                    ->where('transaction_summary_cr_id', '=', (int) $this->listItems[$key]['invoice_no'])
                    ->update([
                        'update_counter_receipt' => 0,
                    ]);
                }

            }elseif ($this->payCrId && !$this->counterReceiptId){
                // Update the counter Receipt
                // Balance //Paid //Total

                if(!empty($data['paid'])){
                    $data['paid'] = floatval(preg_replace('/[^\d.]/', '', $data['paid']));
                }else{
                    $data['paid'] = 0.00;
                }
                if(!empty($data['total'])){
                    $data['total'] = floatval(preg_replace('/[^\d.]/', '', $data['total']));
                }else{
                    $data['total'] = 0.00;
                }

                if($this->payCrId){
                    // Update here the couter receipt data status to paid
                    // $data['status_id'] = Status::PAID;
                }

                CounterReceipt::where('id', $this->payCrId)
                ->update($data);

                // Update product to true in update product column
                foreach ($this->listItems as $key => $value) {
                    if($this->listItems[$key]['payments'] != null){ //$this->listItems[$key]['status_id']
                        if($this->listItems[$key]['status_id'] )
                        CounterReceiptData::where('cr_id', $this->payCrId)
                        ->where('transaction_summary_cr_id', $this->listItems[$key]['invoice_no'])
                        ->update([
                            'transaction_payment_cr_id' => $this->listItems[$key]['payments'],
                            'status_id' => Status::PAID,
                        ]);
                    }
                }

            }else{
                
                // Convert the string debits and credits into float bfore to save
                foreach ($data as $key => $value) {
                    if(!empty($data['paid'])){
                        $data['paid'] = floatval(preg_replace('/[^\d.]/', '', $data['paid']));
                    }else{
                        $data['paid'] = 0.00;
                    }
                    if(!empty($data['total'])){
                        $data['total'] = floatval(preg_replace('/[^\d.]/', '', $data['total']));
                    }else{
                        $data['total'] = 0.00;
                    }

                    // $data['entries'] = strval($data['entries']);
                }

                $data['transaction_status_id'] = EnumsTransactionStatus::SETUP;

                $counterReceiptData = CounterReceipt::create($data);

                // Convert the string debits and credits into float bfore to save
                foreach ($this->listItems as $key => $value) {
                    if(!empty($value['net_amount'])){
                        $value['net_amount'] = floatval(preg_replace('/[^\d.]/', '', $value['net_amount']));
                    }else{
                        $value['net_amount'] = 0.00;
                    }
                }

                // Create for the counter receipt data
                foreach($this->listItems as $data){
                    CounterReceiptData::create([
                        'cr_id' => $counterReceiptData->id,
                        'transaction_summary_cr_id' => $data['invoice_no'],
                        'status_id' => Status::UNPAID,
                    ]);
                }

            }

		} catch (\Exception $e) {
			dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->counterReceiptId){
            $action = 'edit';
            $message = 'Counter Receipt Successfully Updated';
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Counter Receipt Successfully Saved';
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeCounterReceiptModal');
    }

    public function addItem()
    {
        $this->listItems[] = [
            'invoice_no' => '',
            'ref_date' => '',
            'csa' => '',
            'net_amount' => '',
            'payments' => '',
        ];
        
    }

    public function deleteItem($index)
    {
        unset($this->listItems[$index]);
        $this->listItems = array_values($this->listItems);
        $this->updated();
    }

    public function mount()
    {
        $this->addItem();
    }

    public function render()
    {
        return view('livewire.billing.counter-receipt-form', [
            'clients' => ClientProfile::where('status_id', Status::ACTIVE)->get(),
            'transac' => $this->transac,
            'listUsedInvoices' => $this->listUsedInvoices,
        ]);
    }
}
