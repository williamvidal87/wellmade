<?php

namespace App\Listeners;

use App\Enums\ActivityLogType;
use Illuminate\Auth\Events\Logout;
use App\Models\ActivityLogTable;
use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\Auth; //
use Auth;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        // dd($event->user);  
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
         
        
        $save_logout = new ActivityLogTable;
        $save_logout->log_name = $event->user->email;
        $save_logout->description =  'User '. $event->user->name. ' Logout!';
        $save_logout->subject_id = $event->user->id;;
        $save_logout->subject_type = $actual_link;
        $save_logout->activity_log_type_id = ActivityLogType::USER_LOG;
        $save_logout->causer_id = null;
        $save_logout->causer_type = null;
        $save_logout->properties = null;
        $save_logout->save();
    }
}