<?php

namespace App\Http\Livewire\CRM;

use App\Enums\ActivityLogType;
use App\Models\ActivityLogTable;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Livewire\Component;

class ContactLogTable extends Component
{

    public $start_date, $end_date, $contact_incentives_logs;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'filter_date',
    ];

    public function mount()
    {
        $this->contact_incentives_logs = ActivityLogTable::where('activity_log_type_id', ActivityLogType::CONTACT_INCENTIVES_LOG)->get();
    }

    public function printPdf()
    {
        $date_start      = $this->start_date;  
        $date_end        = $this->end_date;

        $report_data = ActivityLogTable::where('activity_log_type_id', ActivityLogType::CONTACT_INCENTIVES_LOG)
                                    ->where(function($query) use ($date_start, $date_end){
                                        if($date_start && $date_end) {
                                            $query->where('created_at', '>=',$date_start)
                                                ->where('created_at', '<=',Carbon::parse($date_end)->addHour(23)->addMinute(59)->addSecond(59));
                                        }
                                    })->get();
        
        $pdf  = PDF::loadView('livewire.prints.contact-incentive-log', ['report_data' => $report_data])->output(); 
        return response()->streamDownload(
            fn () => print($pdf),"contact-incentive-log.pdf"
        ); 
    }

    public function filter_date($start_date, $end_date)
    {
        if(!empty($start_date) && !empty($end_date)){
            $this->start_date = $start_date;
            $this->end_date = $end_date;
            $this->contact_incentives_logs = ActivityLogTable::where('activity_log_type_id', ActivityLogType::CONTACT_INCENTIVES_LOG)->where(function ($query) {
                if (!is_null($this->start_date) && !is_null($this->end_date)) {
                    $dateFrom = Carbon::parse($this->start_date);
                    $dateTo = Carbon::parse($this->end_date)->addHour(23)->addMinute(59)->addSecond(59);
                    $query->where('created_at', '>=', $dateFrom)
                        ->where('created_at', '<=', $dateTo);
                }
            })->get();
        }

    }

    public function addGenerate()
    {
        $this->emit('resetInputFields');
        $this->emit('openContactLogModal');
    }

    public function render()
    {
        return view('livewire.c-r-m.contact-log-table', [
            'contact_incentives_logs' => $this->contact_incentives_logs,
        ]);
    }
}
