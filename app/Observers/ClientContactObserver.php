<?php

namespace App\Observers;

use App\Enums\ActivityLogType;
use App\Models\ActivityLogTable;
use App\Models\ClientProfile;

class ClientContactObserver
{
    public $afterCommit = true;
    public $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }
    /**
     * Handle the ClientProfile "created" event.
     *
     * @param  \App\Models\ClientProfile  $clientProfile
     * @return void
     */
    public function created(ClientProfile $clientProfile)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $client_contact = new ActivityLogTable();
        $client_contact->log_name = $this->user->email;
        $client_contact->description =  'User '. $this->user->name. ' Created new Client! = ['. $clientProfile->name.']' ;
        $client_contact->subject_id = $this->user->id;;
        $client_contact->subject_type = $actual_link;
        $client_contact->activity_log_type_id = ActivityLogType::USER_LOG;
        $client_contact->causer_id = null;
        $client_contact->causer_type = null;
        $client_contact->properties = null;
        $client_contact->save();
    }

    /**
     * Handle the ClientProfile "updated" event.
     *
     * @param  \App\Models\ClientProfile  $clientProfile
     * @return void
     */
    public function updated(ClientProfile $clientProfile)
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $client_contact = new ActivityLogTable();
        $client_contact->log_name = $this->user->email;
        $client_contact->description =  'User '. $this->user->name. ' Updated new Client! = ['. $clientProfile->name.']' ;
        $client_contact->subject_id = $this->user->id;;
        $client_contact->subject_type = $actual_link;
        $client_contact->activity_log_type_id = ActivityLogType::USER_LOG;
        $client_contact->causer_id = null;
        $client_contact->causer_type = null;
        $client_contact->properties = null;
        $client_contact->save();
    }

    /**
     * Handle the ClientProfile "deleted" event.
     *
     * @param  \App\Models\ClientProfile  $clientProfile
     * @return void
     */
    public function deleted(ClientProfile $clientProfile)
    {
        //
    }

    /**
     * Handle the ClientProfile "restored" event.
     *
     * @param  \App\Models\ClientProfile  $clientProfile
     * @return void
     */
    public function restored(ClientProfile $clientProfile)
    {
        //
    }

    /**
     * Handle the ClientProfile "force deleted" event.
     *
     * @param  \App\Models\ClientProfile  $clientProfile
     * @return void
     */
    public function forceDeleted(ClientProfile $clientProfile)
    {
        //
    }
}
