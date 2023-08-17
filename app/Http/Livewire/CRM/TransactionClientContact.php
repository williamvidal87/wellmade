<?php

namespace App\Http\Livewire\CRM;

use App\Enums\ForTransaction;
use App\Models\ChartOfAccounts;
use App\Models\CounterReceipt;
use App\Models\Subsidiary;
use App\Models\TransactionFor;
use App\Models\TransactionSummary;
use Livewire\Component;

class TransactionClientContact extends Component
{

    public $subsidiaries, $fors, $clientId;
    public $total_bsn, $total_spq, $overall_total = 0;
    public $transactionClientContact = [];
    public $forsTransaction = [];

    protected $listeners = [
        'ContactId',
        'transactionClientContactId',
        'refreshTransactionClientContactParent' => '$refresh',
        'resetTransactionInputFields',
        'viewConfirmCounterReceipt',
    ];

    public function resetTransactionInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function mount()
    {
        $this->transactionClientContact = $this->transactionClientContact;
    }

    public function viewConfirmCounterReceipt($clientId)
    {
        $this->emit('viewCounterReceiptId', $clientId);
        $this->emit('openCounterReceiptModal');
    }

    public function transactionClientContactId($id)
    {
        $this->clientId = $id;
        $transactionsBSN = TransactionSummary::where('transaction_type_id', 2)
            ->where('for', 2)
            ->whereIn('transaction_status_id', [1, 2])
            ->where('status_id', 13)
            ->whereHas('jobOrder', function ($query) use ($id) {
                return $query->where('customer_id', '=', $id);
            })->get();

        $totalBsn = 0;
        foreach ($transactionsBSN as $data) {
            $totalBsn += $data->all_total_debits;
        }

        $this->total_bsn = number_format($totalBsn, 2) ?? number_format(0.0, 2);

        $transactionsSPQ = TransactionSummary::where('transaction_type_id', 2)
            ->where('for', 1)
            ->whereIn('transaction_status_id', [1, 2])
            ->where('status_id', 13)
            ->whereHas('jobOrder', function ($query) use ($id) {
                return $query->where('customer_id', '=', $id);
            })->get();

        $totalSpq = 0;
        foreach ($transactionsSPQ as $data) {
            $totalSpq += $data->all_total_debits;
        }

        $this->total_spq = number_format($totalSpq, 2) ?? number_format(0.0, 2);

        $this->overall_total = number_format($totalSpq + $totalBsn, 2);
    }

    public function updatedSubsidiaries($id)
    {
        if ($id == 1) {
            $this->subsidiaries = $id;
            $this->forsTransaction = TransactionFor::all();
            $this->fors = "";
            $this->transactionClientContact = TransactionSummary::with('fors', 'jobOrder')
                                            ->where('transaction_type_id', 2)
                                            ->whereIn('for', [ForTransaction::SPQ, ForTransaction::BSN])
                                            ->whereIn('transaction_status_id', [1, 2])
                                            ->whereIn('status_id', [12, 13])
                                            ->whereHas('jobOrder', function ($query) {
                                                return $query->where('customer_id', '=', $this->clientId);
                                            })->get();
            // $this->getConsilidated($id);
        } elseif ($id == 2) {
            $this->subsidiaries = $id;
            $this->forsTransaction = TransactionFor::all();
            $this->fors = "";
            $this->transactionClientContact = [];
            // $this->getUnpaidOnly($id);
        } elseif ($id == 3) {
            $this->subsidiaries = $id;
            $this->forsTransaction = TransactionFor::all();
            $this->fors = "";
            $this->transactionClientContact = [];
            // $this->getFullyPaid($id);
        } elseif ($id == 4) {
            // $this->subsidiaries = $id;
            // $this->forsTransaction = TransactionFor::all();
            // $this->fors = "";
            // $this->transactionClientContact = CounterReceipt::with('getCounterReceiptData.getTransactionSummary', 'getClient.forCSA', 'getCounterReceiptData.getTransactionPayment')->where('client_id', $this->clientId)->get();
        }
    }

    public function resetInputFieldsContact()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function updatedFors()
    {
        $this->transactionClientContact = [];
        if ($this->subsidiaries) {
            if ($this->fors == ForTransaction::SPQ) {
                if ($this->subsidiaries == 2){
                    $this->transactionClientContact =
                        TransactionSummary::with('fors', 'jobOrder')
                        ->where('transaction_type_id', 2)
                        ->where('for', ForTransaction::SPQ)
                        ->whereIn('transaction_status_id', [1, 2])
                        ->where('status_id', 13)
                        ->whereHas('jobOrder', function ($query) {
                            return $query->where('customer_id', '=', $this->clientId);
                        })->get();
                }elseif ($this->subsidiaries == 3){
                    $this->transactionClientContact =
                        TransactionSummary::with('fors', 'jobOrder')
                        ->where('transaction_type_id', 2)
                        ->where('for', ForTransaction::SPQ)
                        ->whereIn('transaction_status_id', [1, 2])
                        ->where('status_id', 12)
                        ->whereHas('jobOrder', function ($query) {
                            return $query->where('customer_id', '=', $this->clientId);
                        })->get();
                }
            } elseif ($this->fors == ForTransaction::BSN) {
                if($this->subsidiaries == 2){
                    $this->transactionClientContact =
                        TransactionSummary::with('fors', 'jobOrder')
                        ->where('transaction_type_id', 2)
                        ->where('for', ForTransaction::BSN)
                        ->whereIn('transaction_status_id', [1, 2])
                        ->where('status_id', 13)
                        ->whereHas('jobOrder', function ($query) {
                            return $query->where('customer_id', '=', $this->clientId);
                        })->get();
                        // dd($this->transactionClientContact);
                }elseif($this->subsidiaries == 3){
                    $this->transactionClientContact =
                        TransactionSummary::with('fors', 'jobOrder')
                        ->where('transaction_type_id', 2)
                        ->where('for', ForTransaction::BSN)
                        ->whereIn('transaction_status_id', [1, 2])
                        ->where('status_id', 12)
                        ->whereHas('jobOrder', function ($query) {
                            return $query->where('customer_id', '=', $this->clientId);
                        })->get();
                }
                
            } elseif ($this->fors == "all") {
                if ($this->subsidiaries == 2){
                    $this->transactionClientContact =
                        TransactionSummary::with('fors', 'jobOrder')
                        ->where('transaction_type_id', 2)
                        ->whereIn('for', [ForTransaction::SPQ, ForTransaction::BSN])
                        ->whereIn('transaction_status_id', [1, 2])
                        ->where('status_id', 13)
                        ->whereHas('jobOrder', function ($query) {
                            return $query->where('customer_id', '=', $this->clientId);
                        })->get();
                }elseif ($this->subsidiaries == 3){
                    $this->transactionClientContact =
                        TransactionSummary::with('fors', 'jobOrder')
                        ->where('transaction_type_id', 2)
                        ->whereIn('for', [ForTransaction::SPQ, ForTransaction::BSN])
                        ->whereIn('transaction_status_id', [1, 2])
                        ->where('status_id', 12)
                        ->whereHas('jobOrder', function ($query) {
                            return $query->where('customer_id', '=', $this->clientId);
                        })->get();
                }
            }
        }

        $this->emit('refreshTransactionClientContactParent');
        // $this->resetInputFieldsContact();
    }

    public function render()
    {
        return view('livewire.c-r-m.transaction-client-contact', [
            'subsidiary' => Subsidiary::all(),
            'transactionClientContact' => $this->transactionClientContact,
        ]);
    }
}
