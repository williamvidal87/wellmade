<?php

namespace App\Exports;

use App\Models\ClientProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutosize;

class UserReportListing implements FromView, ShouldAutosize
{
    public  $roles_id;

    public function __construct($roles_id)
    {
        $this->roles_id = $roles_id;
    }
    
    public function view(): View 
    {   
        $user_roles = User::when($this->roles_id, function ($query, $roleIds) {
            $query->role($roleIds);
        })->get();
    
        return view('layouts.exports.user-report-listing',[
            'user_roles' => $user_roles
        ]);
    }
}
