<?php

namespace App\Http\Livewire\CRM;

use Livewire\Component;
use App\Models\ClientProfile;
use App\Models\ClientType;
use App\Models\CsaType;
use App\Exports\ClientReportListing;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\WithPagination;

class ClientReportListingTable extends Component
{
    use WithPagination;

    public $start_date, $end_date, $client_type, $csa_id;

    public $refreshParent = '$refresh';

   

    public function addGenerate()
    {
      $this->emit('openModal');      
    }

    public function printPdf()
    {   
       
        $clientTypes = $this->client_type;
        $csaTypes    = $this->csa_id;
        $date_start = $this->start_date;  
        $date_end   = $this->end_date;
            
        $report_data = ClientProfile::where(function($query) use ($clientTypes, $csaTypes, $date_start, $date_end){

                                    if($clientTypes) {
                                        $query->where('client_type', $clientTypes);
                                    } 
                                    if($csaTypes) {
                                        $query->where('csa_id', $csaTypes);
                                    } 

                                    if($date_start && $date_end) {
                                        $query->where('created_at', '>=',$date_start)
                                                ->where('created_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
                                    }
                                                                
                                })->get();      
                               

        $pdf  = PDF::loadView('livewire.prints.client-report-listing', ['report_data' => $report_data])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"client-report-listing.pdf"
       
        );   
       
       
    }

    public function printExcel()
    {           
        return Excel::download(new ClientReportListing($this->client_type, $this->csa_id, $this->start_date, $this->end_date), 'ClientReportListing.xlsx'); 
      
    }


    public function render()
    {        
       
        $clientTypes = $this->client_type;
        $csaTypes    = $this->csa_id;
        $date_start = $this->start_date;  
        $date_end   = $this->end_date;
      
        $client_profile = ClientProfile::where(function($query) use ($clientTypes,  $csaTypes, $date_start, $date_end){

                                                if($clientTypes) {
                                                    $query->where('client_type', $clientTypes);
                                                }   
                                                if($csaTypes) {
                                                    $query->where('csa_id', $csaTypes);
                                                }                
                                                if($date_start && $date_end) {
                                                    $query->where('created_at', '>=',$date_start)
                                                          ->where('created_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
                                                }

                                        })->get();     

        $client_t =  ClientType::all();
        $csa_t =  CsaType::all();

        $this->client_p    = $client_profile;
        $this->clientType  = $clientTypes;
        $this->csaType     = $csaTypes;
        $this->client_ty   = $client_t;
        $this->csa_ty    = $csa_t;
       
        return view('livewire.c-r-m.client-report-listing-table',[
            'client_profile'         => $this->client_p,         //client profile
            'current_client_type'    => $this->clientType,      //current client type
            'current_csa_type'       => $this->csaType,
            'client'                 => $this->client_ty,       //client type
            'csa'                    => $this->csa_ty
        ]);         
       
    } 
    
}
