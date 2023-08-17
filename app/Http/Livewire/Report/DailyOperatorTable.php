<?php

namespace App\Http\Livewire\Report;

use App\Enums\Status;
use App\Models\AddWorker;
use App\Models\Holiday;
use App\Models\JobTypes;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DailyOperatorTable extends Component
{

    public $start_date, $start_d, $work_type_id;
    public $work_order = [];

    public function addGenerate()
    {
        $this->emit('openModal');
    }

    public function mount()
    {
        $start = Carbon::now()->format('Y-m-d');
    }

    public function printPdf()
    {
        if($this->start_date != null && $this->work_type_id){

            if($this->work_type_id == 1){
                $this->work_order = AddWorker::with('getWorkOrder.getJobOrder')
                ->whereNotNull(['start', 'end'])
                ->where(DB::raw("STR_TO_DATE('start', '%Y-%m-%d')"), "=", Carbon::parse($this->start_date)->format('Y-m-d'))
                ->whereHas('getWorkOrder', function ($query) {
                    $query->where('job_type_id', 1);
                    $query->where('status', Status::DONE);
                })->get()
                ->groupBy('getWorker.name')
                ->toArray();

            }elseif($this->work_type_id == 2){
                $this->work_order = AddWorker::with('getWorkOrder.getJobOrder')
                ->whereNotNull(['start', 'end'])
                ->where(DB::raw("(STR_TO_DATE(start,'%Y-%m-%d'))"), "=", Carbon::parse($this->start_date)->format('Y-m-d'))
                ->whereHas('getWorkOrder', function ($query) {
                    $query->where('job_type_id', 2);
                    $query->where('status', Status::DONE);
                })->get()
                ->groupBy('getWorker.name')
                ->toArray();
                
            }elseif($this->work_type_id == 3){
                $this->work_order = AddWorker::with('getWorkOrder.getJobOrder')
                ->whereNotNull(['start', 'end'])
                ->where(DB::raw("STR_TO_DATE('start', '%Y-%m-%d')"), "=", Carbon::parse($this->start_date)->format('Y-m-d'))
                ->whereHas('getWorkOrder', function ($query) {
                    $query->where('job_type_id', 3);
                    $query->where('status', Status::DONE);
                })->get()
                ->groupBy('getWorker.name')
                ->toArray();
                
            }

            $pdf  = PDF::loadView('livewire.prints.daily-operator', ['work_orders' => $this->work_order, 'work_type_id' => $this->work_type_id, 'start_date' => $this->start_date, 'holidays' => Holiday::whereYear('date', Carbon::now()->year)->get()])->output(); 
            return response()->streamDownload(
                fn () => print($pdf),"daily-operator-efficiency.pdf"
            );  

        }
    }

    public function render()
    {
        if($this->start_date == null && $this->work_type_id == null){
            $start = Carbon::now()->format('Y-m-d');
            $this->start_date = $start;
            $this->work_type_id = 1;
        }else{
            $start = $this->start_date;
        }

        if($this->start_date != null && $this->work_type_id){

            if($this->work_type_id == 1){
                $this->work_order = AddWorker::with('getWorkOrder.getJobOrder')
                ->whereNotNull(['start', 'end'])
                ->where(DB::raw("STR_TO_DATE('start', '%Y-%m-%d')"), "=", Carbon::parse($this->start_date)->format('Y-m-d'))
                ->whereHas('getWorkOrder', function ($query) {
                    $query->where('job_type_id', 1);
                    $query->where('status', Status::DONE);
                })->get()
                ->groupBy('getWorker.name')
                ->toArray();
                
            }elseif($this->work_type_id == 2){
                $this->work_order = AddWorker::with('getWorkOrder.getJobOrder')
                ->whereNotNull(['start', 'end'])
                ->where(DB::raw("(STR_TO_DATE(start,'%Y-%m-%d'))"), "=", Carbon::parse($this->start_date)->format('Y-m-d'))
                ->whereHas('getWorkOrder', function ($query) {
                    $query->where('job_type_id', 2);
                    $query->where('status', Status::DONE);
                })->get()
                ->groupBy('getWorker.name')
                ->toArray();
                
            }elseif($this->work_type_id == 3){
                $this->work_order = AddWorker::with('getWorkOrder.getJobOrder')
                ->whereNotNull(['start', 'end'])
                ->where(DB::raw("STR_TO_DATE('start', '%Y-%m-%d')"), "=", Carbon::parse($this->start_date)->format('Y-m-d'))
                ->whereHas('getWorkOrder', function ($query) {
                    $query->where('job_type_id', 3);
                    $query->where('status', Status::DONE);
                })->get()
                ->groupBy('getWorker.name')
                ->toArray();
                
            }

            // dd($this->work_order);
        }
        // dd($this->work_order);
        return view('livewire.report.daily-operator-table', [
            'job_types' => JobTypes::all(),
            'holidays' => Holiday::whereYear('date', Carbon::now()->year)->get(),
            'work_orders' => $this->work_order,
            'start_d' => $start,
        ]);
    }
}
