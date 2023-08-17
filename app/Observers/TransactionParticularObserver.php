<?php

namespace App\Observers;

use App\Enums\ActivityLogType;
use App\Models\ActivityLogTable;
use App\Models\TransactionParticular;

class TransactionParticularObserver
{

    public $afterCommit = true;
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();        
    }

    /**
     * Handle the TransactionParticular "created" event.
     *
     * @param  \App\Models\TransactionParticular  $transactionParticular
     * @return void
     */
    public function created(TransactionParticular $transactionParticular)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $payment_logs = new ActivityLogTable();
        $payment_logs->log_name = $this->user->name;
        if($transactionParticular->transactionSummaryReceipt->receipt_type_id == 1){
            $payment_logs->description =  $this->user->name. ' created a receipts payment: ['. $transactionParticular->transactionSummaryReceipt->ar_transaction . '] with the amount of ['. number_format($transactionParticular->total_paid, 2) . ']';
        }else{
            $payment_logs->description =  $this->user->name. ' created a receipts payment: ['. $transactionParticular->transactionSummaryReceipt->or_transaction. '] with the amount of ['. number_format($transactionParticular->total_paid, 2) . ']';
        }
        $payment_logs->subject_id = $this->user->id;
        $payment_logs->subject_type = $actual_link;
        $payment_logs->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
        $payment_logs->causer_id = null;
        $payment_logs->causer_type = null;
        $payment_logs->properties = null;
        $payment_logs->save();
    }

    /**
     * Handle the TransactionParticular "updated" event.
     *
     * @param  \App\Models\TransactionParticular  $transactionParticular
     * @return void
     */
    public function updated(TransactionParticular $transactionParticular)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $payment_logs = new ActivityLogTable();
        $payment_logs->log_name = $this->user->name;
        if($transactionParticular->transactionSummaryReceipt->receipt_type_id == 1){
            $payment_logs->description =  $this->user->name. ' updated a receipts payment: ['. $transactionParticular->transactionSummaryReceipt->ar_transaction . '] with the amount of ['. number_format($transactionParticular->total_paid, 2) . ']';
        }else{
            $payment_logs->description =  $this->user->name. ' updated a receipts payment: ['. $transactionParticular->transactionSummaryReceipt->or_transaction. '] with the amount of ['. number_format($transactionParticular->total_paid, 2) . ']';
        }
        $payment_logs->subject_id = $this->user->id;
        $payment_logs->subject_type = $actual_link;
        $payment_logs->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
        $payment_logs->causer_id = null;
        $payment_logs->causer_type = null;
        $payment_logs->properties = null;
        $payment_logs->save();
    }

    /**
     * Handle the TransactionParticular "deleted" event.
     *
     * @param  \App\Models\TransactionParticular  $transactionParticular
     * @return void
     */
    public function deleted(TransactionParticular $transactionParticular)
    {
        //
    }

    /**
     * Handle the TransactionParticular "restored" event.
     *
     * @param  \App\Models\TransactionParticular  $transactionParticular
     * @return void
     */
    public function restored(TransactionParticular $transactionParticular)
    {
        //
    }

    /**
     * Handle the TransactionParticular "force deleted" event.
     *
     * @param  \App\Models\TransactionParticular  $transactionParticular
     * @return void
     */
    public function forceDeleted(TransactionParticular $transactionParticular)
    {
        //
    }
}
