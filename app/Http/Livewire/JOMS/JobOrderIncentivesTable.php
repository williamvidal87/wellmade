<?php

namespace App\Http\Livewire\JOMS;

use App\Enums\ReceiptType;
use App\Models\Contact;
use App\Models\JobOrder;
use App\Models\TransactionParticular;
use App\Models\TransactionSummary;
use App\Models\WorkOrder;
use App\Models\WvTransaction;
use App\Service\IncentiveService;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;

class JobOrderIncentivesTable extends Component
{

    public $contact_person_id;

    protected $listeners = [
        'unlockAccess'
    ];

    public function unlockAccess($id){
        JobOrder::where('id', $id)->update([
            'printed_incentive' => 0
        ]);
    }

    public function approveUnlockAccess($dataID)
    {
        $this->emit('openUnlockAccessModal');
        $this->emit('setUnlockAccessUser', $dataID);
    }

    public function checkRole()
    {
        $roles = [];
        $userrole = auth()->user()->roles;

        foreach ($userrole as $key => $value) {
            $roles[] = $value->name;
        }

        if (in_array("Admin", $roles)) {
            return true;
        }elseif(in_array("Super Admin", $roles)){
            return true;
        }else{
            return false;
        }
    }

    public function checkAbleToPrint()
    {
        $roles = [];
        $userrole = auth()->user()->roles;

        foreach ($userrole as $key => $value) {
            $roles[] = $value->name;
        }

        if (in_array("Encoder", $roles)) {
            return true;
        }else{
            return false;
        }
    }

    public function viewReport($id)
    {
        $this->emit('viewIncentives', $id);
        $this->emit('openViewIncentives');
    }

    public function incentiveReport($id, IncentiveService $incentiveService)
    {
        if($id != null){
            $job_order_info = JobOrder::with('getContact', 'getContact.getClientType.getIndustry', 'getContact.getCsaType', 'clientProfile')->where('contact_person', '!=', null)->where('id', $id)->first();
            $transaction_info = TransactionSummary::with('jobOrder', 'jobOrder.WorkOrders')->where('jo_no',$id)->where('transaction_status_id', 2)->where('status_id', 12)->first();
            $work_order = WorkOrder::with('getJobOrder', 'getIncentiveType')->where('jo_no_id',$id)->where('status', '!=' , 3)->get();
            $transac_id = TransactionParticular::with('transactionSummaryReceipt')->where('transaction_summary_invoice_id', $transaction_info->id)->first();
            $transaction_particulars = TransactionParticular::with('transactionSummaryReceipt', 'transactionSummaryInvoice')->where('transaction_summary_invoice_id', $transaction_info->id)->first();
            $invoice_date = $transaction_particulars->transactionSummaryInvoice->date;
            $receipt_date = $transaction_particulars->transactionSummaryReceipt->date; 
            $date_invoice = date('Y-m-d', strtotime($invoice_date));
            $date_receipt = date('Y-m-d', strtotime($receipt_date));
            if($this->checkAbleToPrint()){
                // Update the printed_incentive
                JobOrder::where('id', $id)->update([
                    'printed_incentive' => 1
                ]);
            }

            if($transaction_info->sb_invoice_no != null){
                if($transac_id->transactionSummaryReceipt->receipt_type_id == ReceiptType::AR){
                    $transac_id = $transac_id->transactionSummaryReceipt->ar_transaction ?? '';
                }else{
                    $transac_id = $transac_id->transactionSummaryReceipt->or_transaction ?? '';
                }
            }else{
                if($transac_id->transactionSummaryReceipt->receipt_type_id == ReceiptType::OR){
                    $transac_id = $transac_id->transactionSummaryReceipt->or_transaction ?? '';
                }else{
                    $transac_id = $transac_id->transactionSummaryReceipt->ar_transaction ?? '';
                }
            }

            $records = array(
                'data'=> $job_order_info,
                'transaction_info' =>$transaction_info,
                'related_work_order'=>$work_order,
                'transaction_id' => $transac_id ?? '',
                'token_scan' => $job_order_info->token_scan ?? $job_order_info->id . '-'. $job_order_info->jo_no,
                'date_invoice' => $date_invoice,
                'date_receipt' => $date_receipt,
            );

            // update the incentive incase their is a changes in incentive type/discount
            $total_incentive = $incentiveService->calculateIncentive($id);
            JobOrder::where('id', $id)->update([
                'total_incentive' => $total_incentive, 
            ]);

            $pdfContent = PDF::loadView('livewire.prints.incentive-report', ['records'=>$records, 'invoice_date' => $invoice_date, 'receipt_date' => $receipt_date])->output();
            redirect()->to('/job-order-incentives');
            return response()->streamDownload(
            fn () => print($pdfContent),
            "INCENTIVE_VOUCHER.pdf"
            );
        }

    }

    public function render()
    {
        return view('livewire.j-o-m-s.job-order-incentives-table', [
            'job_orders' => JobOrder::with('clientProfile.contacts', 'WorkOrders', 'getContact')->where('contact_person', '!=', null)->whereIn('status', [1,2,3,4,9])->where('payment_status_id', 12)->get(),
            'contact_persons' => Contact::all(),
        ]);
    }
}
