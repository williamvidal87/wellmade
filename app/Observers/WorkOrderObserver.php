<?php

namespace App\Observers;

use App\Enums\ActivityLogType;
use App\Models\ActivityLogTable;
use App\Models\WorkOrder;

class WorkOrderObserver
{
    public $afterCommit = true;
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }
    /**
     * Handle the WorkOrder "created" event.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return void
     */
    public function created(WorkOrder $workOrder)
    {
        if ($workOrder->job_type_id == 1) { 
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $work_order = new ActivityLogTable();
            $work_order->log_name = $this->user->email;
            $work_order->description =  'User '. $this->user->name. ' Created new MF! = ['. $workOrder->reference_no_id .']' ;
            $work_order->subject_id = $this->user->id;;
            $work_order->subject_type = $actual_link;
            $work_order->activity_log_type_id = ActivityLogType::USER_LOG; 
            $work_order->causer_id = null;
            $work_order->causer_type = null;
            $work_order->properties = null;
            $work_order->save();
         }elseif ($workOrder->job_type_id == 2) {
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $work_order = new ActivityLogTable();
            $work_order->log_name = $this->user->email;
            $work_order->description =  'User '. $this->user->name. ' Created new ER! = ['. $workOrder->reference_no_id .']' ;
            $work_order->subject_id = $this->user->id;;
            $work_order->subject_type = $actual_link;
            $work_order->activity_log_type_id = ActivityLogType::USER_LOG; 
            $work_order->causer_id = null;
            $work_order->causer_type = null;
            $work_order->properties = null;
            $work_order->save();
         }elseif ($workOrder->job_type_id == 3) {
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $work_order = new ActivityLogTable();
            $work_order->log_name = $this->user->email;
            $work_order->description =  'User '. $this->user->name. ' Created new CALIB! = ['. $workOrder->reference_no_id .']' ;
            $work_order->subject_id = $this->user->id;;
            $work_order->subject_type = $actual_link;
            $work_order->activity_log_type_id = ActivityLogType::USER_LOG; 
            $work_order->causer_id = null;
            $work_order->causer_type = null;
            $work_order->properties = null;
            $work_order->save();
         }
    }

    /**
     * Handle the WorkOrder "updated" event.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return void
     */
    public function updated(WorkOrder $workOrder)
    {
        if ($workOrder->job_type_id == 1) { 
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $work_order = new ActivityLogTable();
            $work_order->log_name = $this->user->email;
            $work_order->description =  'User '. $this->user->name. ' Created new MF! = ['. $workOrder->reference_no_id .']' ;
            $work_order->subject_id = $this->user->id;;
            $work_order->subject_type = $actual_link;
            $work_order->activity_log_type_id = ActivityLogType::USER_LOG; 
            $work_order->causer_id = null;
            $work_order->causer_type = null;
            $work_order->properties = null;
            $work_order->save();
         }elseif ($workOrder->job_type_id == 2) {
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $work_order = new ActivityLogTable();
            $work_order->log_name = $this->user->email;
            $work_order->description =  'User '. $this->user->name. ' Created new ER! = ['. $workOrder->reference_no_id .']' ;
            $work_order->subject_id = $this->user->id;;
            $work_order->subject_type = $actual_link;
            $work_order->activity_log_type_id = ActivityLogType::USER_LOG; 
            $work_order->causer_id = null;
            $work_order->causer_type = null;
            $work_order->properties = null;
            $work_order->save();
         }elseif ($workOrder->job_type_id == 3) {
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $work_order = new ActivityLogTable();
            $work_order->log_name = $this->user->email;
            $work_order->description =  'User '. $this->user->name. ' Created new CALIB! = ['. $workOrder->reference_no_id .']' ;
            $work_order->subject_id = $this->user->id;;
            $work_order->subject_type = $actual_link;
            $work_order->activity_log_type_id = ActivityLogType::USER_LOG; 
            $work_order->causer_id = null;
            $work_order->causer_type = null;
            $work_order->properties = null;
            $work_order->save();
         }
    }

    /**
     * Handle the WorkOrder "deleted" event.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return void
     */
    public function deleted(WorkOrder $workOrder)
    {
        //
    }

    /**
     * Handle the WorkOrder "restored" event.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return void
     */
    public function restored(WorkOrder $workOrder)
    {
        //
    }

    /**
     * Handle the WorkOrder "force deleted" event.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return void
     */
    public function forceDeleted(WorkOrder $workOrder)
    {
        //
    }
}
