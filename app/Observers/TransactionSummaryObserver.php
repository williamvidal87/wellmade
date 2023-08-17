<?php

namespace App\Observers;

use App\Enums\ActivityLogType;
use App\Enums\ServiceInvoice;
use App\Models\ActivityLogTable;
use App\Models\TransactionSummary;

class TransactionSummaryObserver
{
    public $afterCommit = true;
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();        
    }

    /**
     * Handle the TransactionSummary "created" event.
     *
     * @param  \App\Models\TransactionSummary  $transactionSummary
     * @return void
     */
    public function created(TransactionSummary $transactionSummary)
    {
        if($transactionSummary->transaction_type_id == ServiceInvoice::SERVICE_INVOICE){

        //     $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //     $payment_logs = new ActivityLogTable();
        //     $payment_logs->log_name = $this->user->name;
        //     if($transactionSummary->receipt_type_id == 1){
        //         $payment_logs->description =  $this->user->name. ' created a receipts payment: ['. $transactionSummary->ar_transaction . '] with the amount of ['. number_format($transactionSummary->all_total_debits, 2) . '] Status of ['. $transactionSummary->transactionStatus->name . ']';
        //     }else{
        //         $payment_logs->description =  $this->user->name. ' created a receipts payment: ['. $transactionSummary->or_transaction. '] with the amount of ['. number_format($transactionSummary->all_total_debits, 2) . '] Status of ['. $transactionSummary->transactionStatus->name . ']';
        //     }
        //     $payment_logs->subject_id = $this->user->id;
        //     $payment_logs->subject_type = $actual_link;
        //     $payment_logs->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
        //     $payment_logs->causer_id = null;
        //     $payment_logs->causer_type = null;
        //     $payment_logs->properties = null;
        //     $payment_logs->save();

        // }else{

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $payment_logs = new ActivityLogTable();
            $payment_logs->log_name = $this->user->name;
            if($transactionSummary->invoice_type_id == 1){
                $payment_logs->description =  $this->user->name. ' created a service invoice: ['. $transactionSummary->sb_invoice_no. '] with the amount of ['. number_format($transactionSummary->all_total_debits, 2) . '] Status of ['. $transactionSummary->transactionStatus->name . ']';
            }else{
                $payment_logs->description =  $this->user->name. ' created a service invoice: ['. $transactionSummary->wv_invoice_no. '] with the amount of ['. number_format($transactionSummary->all_total_debits, 2) . '] Status of ['. $transactionSummary->transactionStatus->name . ']';
            }
            $payment_logs->subject_id = $this->user->id;
            $payment_logs->subject_type = $actual_link;
            $payment_logs->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
            $payment_logs->causer_id = null;
            $payment_logs->causer_type = null;
            $payment_logs->properties = null;
            $payment_logs->save();

        }
    }

    /**
     * Handle the TransactionSummary "updated" event.
     *
     * @param  \App\Models\TransactionSummary  $transactionSummary
     * @return void
     */
    public function updated(TransactionSummary $transactionSummary)
    {
        if($transactionSummary->transaction_type_id == ServiceInvoice::SERVICE_INVOICE){

        //     $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //     $payment_logs = new ActivityLogTable();
        //     $payment_logs->log_name = $this->user->name;
        //     if($transactionSummary->receipt_type_id == 1){
        //         $payment_logs->description =  $this->user->name. ' updated a receipts payment: ['. $transactionSummary->ar_transaction . '] with the amount of ['. number_format($transactionSummary->all_total_debits, 2) . '] Status of ['. $transactionSummary->transactionStatus->name . ']';
        //     }else{
        //         $payment_logs->description =  $this->user->name. ' updated a receipts payment: ['. $transactionSummary->or_transaction. '] with the amount of ['. number_format($transactionSummary->all_total_debits, 2) . '] Status of ['. $transactionSummary->transactionStatus->name . ']';
        //     }
        //     $payment_logs->subject_id = $this->user->id;
        //     $payment_logs->subject_type = $actual_link;
        //     $payment_logs->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
        //     $payment_logs->causer_id = null;
        //     $payment_logs->causer_type = null;
        //     $payment_logs->properties = null;
        //     $payment_logs->save();

        // }else{

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $payment_logs = new ActivityLogTable();
            $payment_logs->log_name = $this->user->name;
            if($transactionSummary->invoice_type_id == 1){
                $payment_logs->description =  $this->user->name. ' updated a service invoice: ['. $transactionSummary->sb_invoice_no. '] with the amount of ['. number_format($transactionSummary->all_total_debits, 2) . '] Status of ['. $transactionSummary->transactionStatus->name . ']';
            }else{
                $payment_logs->description =  $this->user->name. ' updated a service invoice: ['. $transactionSummary->wv_invoice_no. '] with the amount of ['. number_format($transactionSummary->all_total_debits, 2) . '] Status of ['. $transactionSummary->transactionStatus->name . ']';
            }
            $payment_logs->subject_id = $this->user->id;
            $payment_logs->subject_type = $actual_link;
            $payment_logs->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
            $payment_logs->causer_id = null;
            $payment_logs->causer_type = null;
            $payment_logs->properties = null;
            $payment_logs->save();

        }
    }

    /**
     * Handle the TransactionSummary "deleted" event.
     *
     * @param  \App\Models\TransactionSummary  $transactionSummary
     * @return void
     */
    public function deleted(TransactionSummary $transactionSummary)
    {
        //
    }

    /**
     * Handle the TransactionSummary "restored" event.
     *
     * @param  \App\Models\TransactionSummary  $transactionSummary
     * @return void
     */
    public function restored(TransactionSummary $transactionSummary)
    {
        //
    }

    /**
     * Handle the TransactionSummary "force deleted" event.
     *
     * @param  \App\Models\TransactionSummary  $transactionSummary
     * @return void
     */
    public function forceDeleted(TransactionSummary $transactionSummary)
    {
        //
    }
}
