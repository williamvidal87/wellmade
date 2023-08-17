<?php

namespace App\Observers;

use App\Enums\ActivityLogType;
use App\Models\ActivityLogTable;
use App\Models\BillingSupplier;

class SupplierObserver
{

    public $afterCommit = true;
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();        
    }

    /**
     * Handle the BillingSupplier "created" event.
     *
     * @param  \App\Models\BillingSupplier  $billingSupplier
     * @return void
     */
    public function created(BillingSupplier $billingSupplier)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $counter_receipt = new ActivityLogTable();
        $counter_receipt->log_name = $this->user->name;
        $counter_receipt->description =  $this->user->name. ' created a supplier: ['. $billingSupplier->name . '] from ['. $billingSupplier->address . ']';
        $counter_receipt->subject_id = $this->user->id;
        $counter_receipt->subject_type = $actual_link;
        $counter_receipt->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
        $counter_receipt->causer_id = null;
        $counter_receipt->causer_type = null;
        $counter_receipt->properties = null;
        $counter_receipt->save();
    }

    /**
     * Handle the BillingSupplier "updated" event.
     *
     * @param  \App\Models\BillingSupplier  $billingSupplier
     * @return void
     */
    public function updated(BillingSupplier $billingSupplier)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $counter_receipt = new ActivityLogTable();
        $counter_receipt->log_name = $this->user->name;
        $counter_receipt->description =  $this->user->name. ' updated a supplier: ['. $billingSupplier->name . '] from ['. $billingSupplier->address . ']';
        $counter_receipt->subject_id = $this->user->id;
        $counter_receipt->subject_type = $actual_link;
        $counter_receipt->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
        $counter_receipt->causer_id = null;
        $counter_receipt->causer_type = null;
        $counter_receipt->properties = null;
        $counter_receipt->save();
    }

    /**
     * Handle the BillingSupplier "deleted" event.
     *
     * @param  \App\Models\BillingSupplier  $billingSupplier
     * @return void
     */
    public function deleted(BillingSupplier $billingSupplier)
    {
        //
    }

    /**
     * Handle the BillingSupplier "restored" event.
     *
     * @param  \App\Models\BillingSupplier  $billingSupplier
     * @return void
     */
    public function restored(BillingSupplier $billingSupplier)
    {
        //
    }

    /**
     * Handle the BillingSupplier "force deleted" event.
     *
     * @param  \App\Models\BillingSupplier  $billingSupplier
     * @return void
     */
    public function forceDeleted(BillingSupplier $billingSupplier)
    {
        //
    }
}
