<?php

namespace App\Listeners;

use App\Enums\ActivityLogType;
use Illuminate\Auth\Events\Login;
use App\Models\ActivityLogTable;
use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\Auth; //
use Auth;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // dd($event->user);   
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
               
        $save_login = new ActivityLogTable;
        $save_login->log_name = $event->user->email;
        $save_login->description = 'User '. $event->user->name. ' Login!';
        $save_login->subject_id = $event->user->id;
        $save_login->subject_type = $actual_link;
        $save_login->activity_log_type_id = ActivityLogType::USER_LOG;
        $save_login->causer_id = null;
        $save_login->causer_type = null;
        $save_login->properties = null;         
        $save_login->save();
    }
}