<?php

namespace App\Exports;

use App\Models\ClientProfile;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutosize;

class ClientReportListing implements FromView, ShouldAutosize
{
    public  $client_type,  $startDate, $endDate;

    public function __construct($client_type, $csa_id, $startDate, $endDate)
    {
        $this->client_type = $client_type;
        $this->csa_id    = $csa_id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function view(): View 
    {   
        $client_report_list = ClientProfile::when($this->client_type, function($query) {
                                                $query->where('client_type', $this->client_type);
                                            })
                                            ->when($this->csa_id, function($query) {
                                                $query->where('csa_id', $this->csa_id);
                                            })
                                            ->when($this->startDate && $this->endDate, function($query) {
                                                $query->where('created_at', '>=',$this->startDate)
                                                    ->where('created_at', '<=', Carbon::parse($this->endDate)->addHour(23)->addMinute(59)->addSecond(59));
                                            })
                                            ->get();           
    
        return view('layouts.exports.client-report-listing',[
            'client_report_list' => $client_report_list
        ]);
    }
}
