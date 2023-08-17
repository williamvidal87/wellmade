<?php

namespace App\Http\Livewire\UMS;

use App\Exports\UserReportListing;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserReportListingTable extends Component
{
    public $roles_id;

    public function addGenerate() 
    {
        $this->emit('openModal');
    }

    public function printPdf()
    {
        $user_roles = User::when($this->roles_id, function ($query, $roleIds) {
            $query->role($roleIds);
        })->get();

        $pdf  = PDF::loadView('livewire.prints.user-report-listing', ['user_report' => $user_roles])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"user-report-listing.pdf"
       
        );   
    }

    public function printExcel()
    {           
        return Excel::download(new UserReportListing($this->roles_id), 'UserReportListing.xlsx');       
    }

    public function render()
    {
   
        $user_roles = User::when($this->roles_id, function ($query, $roleIds) {
            $query->role($roleIds);
        })
        ->get()->except(1);  
    

        return view('livewire.u-m-s.user-report-listing-table', [
            'user_report' => $user_roles,
            // 'user_report' => User::all(),
            'user_role' => Role::all()
        ]);
    }
}
