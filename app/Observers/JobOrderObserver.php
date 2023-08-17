<?php

namespace App\Observers;

use App\Enums\ActivityLogType;
use App\Models\ActivityLogTable;
use App\Models\JobOrder;

class JobOrderObserver
{
    public $afterCommit = true;
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }
    /**
     * Handle the JobOrder "created" event.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return void
     */
    public function created(JobOrder $jobOrder)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $job_order = new ActivityLogTable();
        $job_order->log_name = $this->user->email;
        $job_order->description =  'User '. $this->user->name. ' Created new Job Order! = ['. $jobOrder->jo_no.']' ;
        $job_order->subject_id = $this->user->id;;
        $job_order->subject_type = $actual_link;
        $job_order->activity_log_type_id = ActivityLogType::USER_LOG;
        $job_order->causer_id = null;
        $job_order->causer_type = null;
        $job_order->properties = null;
        $job_order->save();
    }

    /**
     * Handle the JobOrder "updated" event.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return void
     */
    public function updated(JobOrder $jobOrder)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $job_order = new ActivityLogTable();
        $job_order->log_name = $this->user->email;
        $job_order->description =  'User '. $this->user->name. ' Created new Job Order! = ['. $jobOrder->jo_no.']' ;
        $job_order->subject_id = $this->user->id;;
        $job_order->subject_type = $actual_link;
        $job_order->activity_log_type_id = ActivityLogType::USER_LOG;
        $job_order->causer_id = null;
        $job_order->causer_type = null;
        $job_order->properties = null;
        $job_order->save();
    }

    /**
     * Handle the JobOrder "deleted" event.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return void
     */
    public function deleted(JobOrder $jobOrder)
    {
        //
    }

    /**
     * Handle the JobOrder "restored" event.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return void
     */
    public function restored(JobOrder $jobOrder)
    {
        //
    }

    /**
     * Handle the JobOrder "force deleted" event.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return void
     */
    public function forceDeleted(JobOrder $jobOrder)
    {
        //
    }
}
