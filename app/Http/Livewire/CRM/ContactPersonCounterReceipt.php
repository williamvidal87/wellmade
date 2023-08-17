<?php

namespace App\Http\Livewire\CRM;

use App\Enums\TransactionStatus;
use App\Models\CounterReceipt;
use Livewire\Component;

class ContactPersonCounterReceipt extends Component
{
    public $clientId;
    public $transactionClientContact = [];
    public $total = 0;
    public $listItems = [];

    protected $listeners = [
        'refreshCounterReceiptClientContactParent' => '$refresh',
        'viewCounterReceiptId',
        'resetCounterReceiptInputFields',
    ];

    public function resetCounterReceiptInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function viewCounterReceiptId($clientId)
    {
        $this->resetCounterReceiptInputFields();
        $this->clientId = $clientId;
        $this->transactionClientContact = CounterReceipt::with('getCounterReceiptData.getTransactionSummary', 'getClient.forCSA', 'getCounterReceiptData.getTransactionPayment')->where('client_id', $this->clientId)->where('transaction_status_id', '!=', TransactionStatus::REVERSED)->get();
        foreach ($this->transactionClientContact as $key => $value) {
                foreach ($value->getCounterReceiptData as $key => $data) {
                    if($data->getTransactionPayment == null){
                        if($data->getTransactionSummary->invoice_type_id == 1){
                            $this->listItems[] = [
                                'invoice_no' => $data->getTransactionSummary->sb_invoice_no ?? '',
                                'date' => date('Y-m-d', strtotime($data->getTransactionSummary->date)) ?? '',
                                'csa' => $value->getClient->forCSA->csa_type ?? '',
                                'net_amount' => number_format($data->getTransactionSummary->all_total_debits, 2) ?? '',
                                'payment' => 'Unpaid',
                            ];
                        }elseif ($data->getTransactionSummary->invoice_type_id == 2){
                            $this->listItems[] = [
                                'invoice_no' => $data->getTransactionSummary->wv_invoice_no ?? '',
                                'date' => date('Y-m-d', strtotime($data->getTransactionSummary->date)) ?? '',
                                'csa' => $value->getClient->forCSA->csa_type ?? '',
                                'net_amount' => number_format($data->getTransactionSummary->all_total_debits, 2) ?? '',
                                'payment' => 'Unpaid',
                            ];
                        }

                    }else{
                        if($data->getTransactionSummary->invoice_type_id == 1 && $data->getTransactionPayment->receipt_type_id == 2){
                            $this->listItems[] = [
                                'invoice_no' => $data->getTransactionSummary->sb_invoice_no ?? '',
                                'date' => date('Y-m-d', strtotime($data->getTransactionSummary->date)) ?? '',
                                'csa' => $value->getClient->forCSA->csa_type ?? '',
                                'net_amount' => number_format($data->getTransactionSummary->all_total_debits, 2) ?? '',
                                'payment' => $data->getTransactionPayment->or_transaction ?? 'Unpaid',
                            ];
                        }elseif($data->getTransactionSummary->invoice_type_id == 2 && $data->getTransactionPayment->receipt_type_id == 1){
                            $this->listItems[] = [
                                'invoice_no' => $data->getTransactionSummary->wv_invoice_no ?? '',
                                'date' => date('Y-m-d', strtotime($data->getTransactionSummary->date)) ?? '',
                                'csa' => $value->getClient->forCSA->csa_type ?? '',
                                'net_amount' => number_format($data->getTransactionSummary->all_total_debits, 2) ?? '',
                                'payment' => $data->getTransactionPayment->ar_transaction ?? 'Unpaid',
                            ];
                        }
                    }

                }
        }

        $this->emit('refreshCounterReceiptClientContactParent');
    }

    public function render()
    {

        for ($i = 0; $i < sizeof($this->listItems); $i++) {
            if (!empty($this->listItems[$i]['net_amount'])) {
                $this->listItems[$i]['net_amount'] = floatval(preg_replace('/[^\d.]/', '', $this->listItems[$i]['net_amount']));
            }
        }

        $total = 0;
        foreach ($this->listItems as $key => $item) {
            $this->listItems[$key]['net_amount'] = empty($item['net_amount']) ? 0.00 : (is_numeric($item['net_amount']) ? $item['net_amount'] : 0.00);

            $total += round($this->listItems[$key]['net_amount'], 2);
        }
        $this->total = $total;

        $this->total = number_format($this->total, 2);

        for ($i = 0; $i < sizeof($this->listItems); $i++) {
            if ($this->listItems[$i]['net_amount'] == 0.00) {
                $this->listItems[$i]['net_amount'] = "0.00";
            } else {
                $this->listItems[$i]['net_amount'] = number_format((float) $this->listItems[$i]['net_amount'], 2);
            }
        }

        return view('livewire.c-r-m.contact-person-counter-receipt');
    }
}
