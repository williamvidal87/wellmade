<?php

namespace App\Observers;

use App\Enums\ActivityLogType;
use App\Enums\Status;
use App\Models\ActivityLogTable;
use App\Models\JobOrder;
use App\Service\IncentiveService;

class JoAcknowledgementReceiptObserver
{

    public $afterCommit = true;
    public $user;
    private $incentiveService;

    public function __construct(IncentiveService $incentiveService)
    {
        $this->user = auth()->user();
        $this->incentiveService = $incentiveService;        
    }

    /**
     * Handle the JobOrder "created" event.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return void
     */
    public function created(JobOrder $jobOrder)
    {
        //
    }

    /**
     * Handle the JobOrder "updated" event.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return void
     */
    public function updated(JobOrder $jobOrder)
    {

        // For Contact Incentives Log
        if($jobOrder->payment_status_id == Status::PAID && $jobOrder->contact_person != null){

            $total_incentive = $this->incentiveService->calculateIncentive($jobOrder->id);

            if($jobOrder->getTransactionSummary->invoice_type_id == 1){
                $inv_type = $jobOrder->getTransactionSummary->sb_invoice_no;
            }else{
                $inv_type = $jobOrder->getTransactionSummary->wv_invoice_no;
            }

            JobOrder::where('id', $jobOrder->id)->update([
                'total_incentive' => $total_incentive, 
            ]);

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $jo_acknowledgement = new ActivityLogTable();
            $jo_acknowledgement->log_name = $jobOrder->getContact->name;
            $jo_acknowledgement->description =  $jobOrder->getContact->name . ' incentive amount: ['. number_format($total_incentive, 2) . '] Invoice type & id: ['. $inv_type  .'] in the job order: ['. $jobOrder->jo_no . ']';
            $jo_acknowledgement->subject_id = $jobOrder->contact_person;
            $jo_acknowledgement->subject_type = $actual_link;
            $jo_acknowledgement->activity_log_type_id = ActivityLogType::CONTACT_INCENTIVES_LOG;
            $jo_acknowledgement->causer_id = null;
            $jo_acknowledgement->causer_type = null;
            $jo_acknowledgement->properties = null;
            $jo_acknowledgement->save();

        }elseif($jobOrder->overall_total != null){

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $jo_acknowledgement = new ActivityLogTable();
            $jo_acknowledgement->log_name = $this->user->name;
            $jo_acknowledgement->description =  $this->user->name. ' updated a jo acknowledgement receipt: ['. $jobOrder->jo_no . '] with the total amount of ['. number_format($jobOrder->overall_total, 2) . ']';
            $jo_acknowledgement->subject_id = $this->user->id;
            $jo_acknowledgement->subject_type = $actual_link;
            $jo_acknowledgement->activity_log_type_id = ActivityLogType::PAYMENT_LOG;
            $jo_acknowledgement->causer_id = null;
            $jo_acknowledgement->causer_type = null;
            $jo_acknowledgement->properties = null;
            $jo_acknowledgement->save();

        }
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
