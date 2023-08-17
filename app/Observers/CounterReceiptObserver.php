<?php

namespace App\Observers;

use App\Enums\ActivityLogType;
use App\Models\ActivityLogTable;
use App\Models\CounterReceipt;

class CounterReceiptObserver
{

    public $afterCommit = true;
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();        
    }

    /**
     * Handle the CounterReceipt "created" event.
     *
     * @param  \App\Models\CounterReceipt  $counterReceipt
     * @return void
     */
    public function created(CounterReceipt $counterReceipt)
    {

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $counter_receipt = new ActivityLogTable();
            $counter_receipt->log_name = $this->user->name;
            $counter_receipt->description =  $this->user->name. ' created a counter receipt for: ['. $counterReceipt->getClient->name . '] with the amount of ['. number_format($counterReceipt->total, 2) . '] Status of ['. $counterReceipt->getTransactionStatus->name . ']';
            $counter_receipt->subject_id = $this->user->id;
            $counter_receipt->subject_type = $actual_link;
            $counter_receipt->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
            $counter_receipt->causer_id = null;
            $counter_receipt->causer_type = null;
            $counter_receipt->properties = null;
            $counter_receipt->save();

    }

    /**
     * Handle the CounterReceipt "updated" event.
     *
     * @param  \App\Models\CounterReceipt  $counterReceipt
     * @return void
     */
    public function updated(CounterReceipt $counterReceipt)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $counter_receipt = new ActivityLogTable();
        $counter_receipt->log_name = $this->user->name;
        $counter_receipt->description =  $this->user->name. ' updated a counter receipt for: ['. $counterReceipt->getClient->name . '] with the amount of ['. number_format($counterReceipt->total, 2) . '] Status of ['. $counterReceipt->getTransactionStatus->name . ']';
        $counter_receipt->subject_id = $this->user->id;
        $counter_receipt->subject_type = $actual_link;
        $counter_receipt->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
        $counter_receipt->causer_id = null;
        $counter_receipt->causer_type = null;
        $counter_receipt->properties = null;
        $counter_receipt->save();
    }

    /**
     * Handle the CounterReceipt "deleted" event.
     *
     * @param  \App\Models\CounterReceipt  $counterReceipt
     * @return void
     */
    public function deleted(CounterReceipt $counterReceipt)
    {
        //
    }

    /**
     * Handle the CounterReceipt "restored" event.
     *
     * @param  \App\Models\CounterReceipt  $counterReceipt
     * @return void
     */
    public function restored(CounterReceipt $counterReceipt)
    {
        //
    }

    /**
     * Handle the CounterReceipt "force deleted" event.
     *
     * @param  \App\Models\CounterReceipt  $counterReceipt
     * @return void
     */
    public function forceDeleted(CounterReceipt $counterReceipt)
    {
        //
    }
}
