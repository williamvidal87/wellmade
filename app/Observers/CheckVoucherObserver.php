<?php

namespace App\Observers;

use App\Enums\ActivityLogType;
use App\Models\ActivityLogTable;
use App\Models\CheckVoucher;

class CheckVoucherObserver
{

    public $afterCommit = true;
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();        
    }

    /**
     * Handle the CheckVoucher "created" event.
     *
     * @param  \App\Models\CheckVoucher  $checkVoucher
     * @return void
     */
    public function created(CheckVoucher $checkVoucher)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $counter_receipt = new ActivityLogTable();
        $counter_receipt->log_name = $this->user->name;
        $counter_receipt->description =  $this->user->name. ' created a check voucher for: ['. $checkVoucher->getSupplierId->name . '] with the amount of ['. number_format($checkVoucher->amount, 2) . '] Status of ['. $checkVoucher->getTransactionStatus->name . ']';
        $counter_receipt->subject_id = $this->user->id;
        $counter_receipt->subject_type = $actual_link;
        $counter_receipt->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
        $counter_receipt->causer_id = null;
        $counter_receipt->causer_type = null;
        $counter_receipt->properties = null;
        $counter_receipt->save();
    }

    /**
     * Handle the CheckVoucher "updated" event.
     *
     * @param  \App\Models\CheckVoucher  $checkVoucher
     * @return void
     */
    public function updated(CheckVoucher $checkVoucher)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $counter_receipt = new ActivityLogTable();
        $counter_receipt->log_name = $this->user->name;
        $counter_receipt->description =  $this->user->name. ' updated a check voucher for: ['. $checkVoucher->getSupplierId->name . '] with the amount of ['. number_format($checkVoucher->amount, 2) . '] Status of ['. $checkVoucher->getTransactionStatus->name . ']';
        $counter_receipt->subject_id = $this->user->id;
        $counter_receipt->subject_type = $actual_link;
        $counter_receipt->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
        $counter_receipt->causer_id = null;
        $counter_receipt->causer_type = null;
        $counter_receipt->properties = null;
        $counter_receipt->save();
    }

    /**
     * Handle the CheckVoucher "deleted" event.
     *
     * @param  \App\Models\CheckVoucher  $checkVoucher
     * @return void
     */
    public function deleted(CheckVoucher $checkVoucher)
    {
        //
    }

    /**
     * Handle the CheckVoucher "restored" event.
     *
     * @param  \App\Models\CheckVoucher  $checkVoucher
     * @return void
     */
    public function restored(CheckVoucher $checkVoucher)
    {
        //
    }

    /**
     * Handle the CheckVoucher "force deleted" event.
     *
     * @param  \App\Models\CheckVoucher  $checkVoucher
     * @return void
     */
    public function forceDeleted(CheckVoucher $checkVoucher)
    {
        //
    }
}
