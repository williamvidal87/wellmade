<?php

namespace App\Http\Livewire\UserLog;


use Livewire\Component;
use App\Models\ActivityLogTable;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\WithPagination;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class UserActivityLogTable extends Component
{
    use WithPagination;

    public $subject_id, $start_date, $end_date;

    public function addGenerate()
    {
        $this->emit('openModal');
    }

    public function printPdf()
    {
        $date_start      = $this->start_date;  
        $date_end        = $this->end_date;
        $subject_ids       = $this->subject_id;

        $report_data = ActivityLogTable::where(function($query) use ($subject_ids, $date_start, $date_end){

            if($date_start && $date_end) {
                $query->where('updated_at', '>=',$date_start)
                    ->where('updated_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
            }   
            if($subject_ids) {
                $query->where('subject_id',$subject_ids);
            }                              
        })->get()->except(1);    

        $pdf  = PDF::loadView('livewire.prints.user-activity-log', ['report_data' => $report_data])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"user-activity-log.pdf"
        );     
    }

    public function render()    
    {
        $date_start      = $this->start_date;  
        $date_end        = $this->end_date;
        $subject_ids       = $this->subject_id;
       
            
        $report_data = ActivityLogTable::where(function($query) use ($subject_ids, $date_start, $date_end){

            if($date_start && $date_end) {
                $query->where('updated_at', '>=',$date_start)
                    ->where('updated_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
            }   
            if($subject_ids) {
                $query->where('subject_id',$subject_ids);   
            }                                
        })->get();      

        $this->userLogs        = $report_data;
        $this->date_started    = $date_start;
        $this->date_ended      = $date_end;
        $this->subj            = $subject_ids;

        return view('livewire.user-log.user-activity-log-table',[
            'user_log'         => $this->userLogs,
            'start_d'          => $this->date_started,
            'end_d'            => $this->date_ended,   
            'current_user'     => $this->subj , 
            'user'             => User::all()->except(1)          
            
        ]);
    }
}
