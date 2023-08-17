<?php

namespace App\Http\Livewire\Billing;

use App\Enums\ReceiptForTransaction;
use App\Enums\ServiceInvoice as EnumsServiceInvoice;
use App\Enums\Status;
use App\Enums\TransactionStatus;
use App\Models\CounterReceipt;
use App\Models\CounterReceiptData;
use App\Models\JobOrder;
use App\Models\ServiceInvoice;
use App\Models\TransactionSummary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ReceiptsPaymentsTable extends Component
{
    use WithPagination;

    public $serviceInvoiceId, $dateFrom, $dateTo;
    private $receipt_no;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteServiceInvoice',
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function createServiceInvoice()
    {
        $this->emit('resetInputFields');
        $this->resetInputFields();
        $this->emit('openServiceInvoiceModal');
        $this->emit('select2');
        $this->receipt_no =  $this->emit('serviceInvoiceDate', Carbon::today());
        $lastId = TransactionSummary::latest('id')->first();
        if($lastId == null){
            $invoice_no = '-' . str_pad(1, 5, '0', STR_PAD_LEFT);

            $newNumber = [
                'SB' .$invoice_no => 'SB' .$invoice_no,
                'WV' .$invoice_no => 'WV' .$invoice_no,
            ];

        }else{
            $invoice_no = '-' . str_pad(++$lastId->id, 5, '0', STR_PAD_LEFT);

            $newNumber = [
                'SB'. $invoice_no => 'SB'. $invoice_no,
                'WV'. $invoice_no => 'WV'. $invoice_no,
            ];

        }
        

        $this->emit('serviceInvoiceNumber', $newNumber, ReceiptForTransaction::INVOICES);
    }

    public function showServiceInvoice($serviceInvoiceId)
    {
        $this->serviceInvoiceId = $serviceInvoiceId;
        $this->emit('serviceInvoiceId', $this->serviceInvoiceId);
        $this->emit('select2');
        $this->emit('openServiceInvoiceViewModal');
    }


    public function editServiceInvoice($serviceInvoiceId)
    {
        $this->serviceInvoiceId = $serviceInvoiceId;
        $this->emit('serviceInvoiceId', $this->serviceInvoiceId);
        $this->emit('select2');
        $this->emit('openServiceInvoiceModal');
    }

    public function transactionConfirmServiceInvoice($serviceInvoiceId, $data)
    {
        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
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

    public function deleteServiceInvoice($serviceInvoiceId, $data, $particular)
    {
        if($data == "posted"){
            $transaction = TransactionSummary::find($serviceInvoiceId);
            $transaction->update([
                'transaction_status_id' => TransactionStatus::POSTED,
                'status_id' => Status::PAID,
            ]);

            // Paid the individual in particular and jo
            foreach ($particular as $key => $value) {
                if( floatval(preg_replace('/[^\d.]/', '', $value['total_paid'])) > 0 ){
                    TransactionSummary::where('id', $value['transaction_id'])->update([
                        'status_id' => Status::PAID,
                    ]);

                    // Paid the transaction_id if it can be found in the counter receipt
                    $counter_receipt = CounterReceiptData::with('getTransactionSummary')->where('transaction_summary_cr_id', $value['transaction_id'])->first();
                    if($counter_receipt != null){
                        $counter_receipt->update([
                            'transaction_payment_cr_id' => $value['receipt_id'],
                            'status_id' => Status::PAID,
                        ]);

                        // Update the paid in the counter receipt
                        CounterReceipt::find($counter_receipt->cr_id)->increment('paid', $counter_receipt->getTransactionSummary->all_total_debits);
                    }

                    $getJo = TransactionSummary::where('id', $value['transaction_id'])->first();

                    $job_order = JobOrder::find($getJo->jo_no);
                    if($job_order != null){
                        if($job_order->contact_person != null){
                            $job_order->update([
                                'payment_status_id' => Status::PAID,
                                'token_scan' => (string) Str::uuid(),
                            ]);
                        }else{
                            $job_order->update([
                                'payment_status_id' => Status::PAID,
                            ]);
                        }
                    }

                }
            }
            return redirect()->to('/receipts-payments');
        }elseif($data == "reversed"){
            TransactionSummary::where('id',$serviceInvoiceId)->update([
                'status_id' => 3, // 3 => Cancelled status
                'transaction_status_id' => TransactionStatus::REVERSED,
            ]);

            $transaction = TransactionSummary::where('id',$serviceInvoiceId)->where('status_id', 3)->where('transaction_status_id', TransactionStatus::REVERSED)->get();
            if(count($transaction) > 0){
                //Update the Job Order payment status into unpaid
                JobOrder::where('id', $transaction[0]->jo_no)->where('status', 9)->where('payment_status_id', 12)->update([
                    'payment_status_id' => 13,
                ]);
                // Update the Service Invoice status into cancelled and reversed
                TransactionSummary::where('transaction_type_id', 2)->where('jo_no' ,$transaction[0]->jo_no)->update([
                    'status_id' => 3, // 3 => Cancelled status
                    'transaction_status_id' => TransactionStatus::REVERSED,
                ]);
            }
        }

        $this->emit('refreshParent');
        $this->emit('closeServiceInvoiceModal');
    }

    public function render()
    {
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $receiptPayments = TransactionSummary::with('jobOrder', 'transactionStatus', 'clientProfile')->where(function ($query) use ($dateFrom, $dateTo) {
            if (!is_null($dateFrom) && !is_null($dateTo)) {
                $dateFrom = Carbon::parse($this->dateFrom);
                $dateTo = Carbon::parse($this->dateTo)->addHour(23)->addMinute(59)->addSecond(59);
                $query->where('created_at', '>=', $dateFrom)
                    ->where('created_at', '<=', $dateTo)
                    ->where('transaction_type_id', '=', EnumsServiceInvoice::RECEIPTS_PAYMENTS);
            } else {
                $query->where('transaction_type_id', '=', EnumsServiceInvoice::RECEIPTS_PAYMENTS);
            }
        })->get();

        return view('livewire.billing.receipts-payments-table', [
            // 'serviceInvoice' => TransactionSummary::where('transaction_type_id', '=', EnumsServiceInvoice::RECEIPTS_PAYMENTS)->get(),
            'serviceInvoice' => $receiptPayments,
        ]);
    }
}
