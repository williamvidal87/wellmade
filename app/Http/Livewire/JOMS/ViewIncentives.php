<?php

namespace App\Http\Livewire\JOMS;

use App\Enums\ReceiptType;
use App\Models\JobOrder;
use App\Models\TransactionParticular;
use App\Models\TransactionSummary;
use App\Models\WorkOrder;
use Livewire\Component;

class ViewIncentives extends Component
{
    public $job_order_info, $transaction_info, $work_order, $transac_id, $transaction_particulars,
        $invoice_date, $receipt_date, $date_invoice, $date_receipt, $token_scan, $data, $related_work_order,
        $transaction_id, $incentive_id;
    public $records = [];

    protected $listeners = [
        'viewIncentives'
    ];

    public function viewIncentives($id)
    {
        if($id != null){
            $this->incentive_id = $id;
            $this->job_order_info = JobOrder::with('getContact', 'getContact.getClientType.getIndustry', 'getContact.getCsaType', 'clientProfile')->where('contact_person', '!=', null)->where('id', $id)->first();
            $this->transaction_info = TransactionSummary::with('jobOrder', 'jobOrder.WorkOrders')->where('jo_no',$id)->where('transaction_status_id', 2)->where('status_id', 12)->first();
            $this->work_order = WorkOrder::with('getJobOrder', 'getIncentiveType')->where('jo_no_id',$id)->where('status', '!=' , 3)->get();
            $this->transac_id = TransactionParticular::with('transactionSummaryReceipt')->where('transaction_summary_invoice_id', $this->transaction_info->id)->first();
            $this->transaction_particulars = TransactionParticular::with('transactionSummaryReceipt', 'transactionSummaryInvoice')->where('transaction_summary_invoice_id', $this->transaction_info->id)->first();
            $this->invoice_date = $this->transaction_particulars->transactionSummaryInvoice->date;
            $this->receipt_date = $this->transaction_particulars->transactionSummaryReceipt->date; 
            $this->date_invoice = date('Y-m-d', strtotime($this->invoice_date));
            $this->date_receipt = date('Y-m-d', strtotime($this->receipt_date));

            if($this->transaction_info->sb_invoice_no != null){
                if($this->transac_id->transactionSummaryReceipt->receipt_type_id == ReceiptType::AR){
                    $this->transac_id = $this->transac_id->transactionSummaryReceipt->ar_transaction ?? '';
                }else{
                    $this->transac_id = $this->transac_id->transactionSummaryReceipt->or_transaction ?? '';
                }
            }else{
                if($this->transac_id->transactionSummaryReceipt->receipt_type_id == ReceiptType::OR){
                    $this->transac_id = $this->transac_id->transactionSummaryReceipt->or_transaction ?? '';
                }else{
                    $this->transac_id = $this->transac_id->transactionSummaryReceipt->ar_transaction ?? '';
                }
            }

            $this->token_scan = $this->job_order_info->token_scan ?? $this->job_order_info->id . '-'. $this->job_order_info->jo_no; 
            $this->data = $this->job_order_info;
            $this->transaction_info = $this->transaction_info;
            $this->related_work_order = $this->work_order;
            $this->transaction_id = $this->transac_id ?? '';
            $this->date_invoice = $this->date_invoice;
            $this->date_receipt = $this->date_receipt;

            // $this->records = array(
            //     'data'=> $this->job_order_info,
            //     'transaction_info' =>$this->transaction_info,
            //     'related_work_order'=>$this->work_order,
            //     'transaction_id' => $this->transac_id ?? '',
            //     'token_scan' => $this->job_order_info->token_scan ?? $this->job_order_info->id . '-'. $this->job_order_info->jo_no,
            //     'date_invoice' => $this->date_invoice,
            //     'date_receipt' => $this->date_receipt,
            // );

        }
    }

    public function render()
    {
        return view('livewire.j-o-m-s.view-incentives');
    }
}
