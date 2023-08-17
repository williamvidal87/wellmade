<?php

namespace App\Http\Livewire\Report;

use App\Models\AddWorker;
use App\Models\JobOrder;
use App\Models\WorkOrder;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Livewire\Component;

class MonthlyComplienceReportTable extends Component
{

    //ER
   public $delayed_er_id, 
            $total_delayed_er_id,           
            $calculate_delayed_percentage_er_id, 
            $calculate_on_time_percentage_er_id,
            $calculate_total_on_time_percentage_er_id,
            $calculate_total_delayed_percentage_er_id;       
    //MF
   public $delayed_mf_id, 
            $total_delayed_mf_id,           
            $calculate_delayed_percentage_mf_id, 
            $calculate_on_time_percentage_mf_id,
            $calculate_total_on_time_percentage_mf_id,
            $calculate_total_delayed_percentage_mf_id; 

    //CALIB
    public $delayed_calib_id, 
            $total_delayed_calib_id,           
            $calculate_delayed_percentage_calib_id, 
            $calculate_on_time_percentage_calib_id,
            $calculate_total_on_time_percentage_calib_id,
            $calculate_total_delayed_percentage_calib_id;      

    //construct
    private  $count_doing_er,
            $count_done_er,
            $count_doing_mf,
            $count_done_mf,
            $count_doing_calib,
            $count_done_calib,
            $worker,
            $items;
    
    //delayed form      
     public $delayed_reason_id,
            $date_finished_id, 
            $date_year;
  
    public function addDelayed()
    {
        $this->emit('openModalDelayed');
    }

    public function addGenerate() 
    {
        $this->emit('openModalGenerate');
    }
          

    public function __construct()
    {        
              
       $workers = AddWorker::with('getWorkOrder')->whereNotNull(['start']) 
        ->when($this->date_year, function ($query) {
            $query->whereYear('created_at','=',$this->date_year);              
        })->get();
        
        //if getkey !exist.
        $this->worker = collect($workers)
        ->groupBy(function ($item) {
                    return $item->start->format('m');
        });

        $doing_er = 0;
        $done_er = 0;
        $doing_mf = 0;
        $done_mf = 0;
        $doing_calib = 0;
        $done_calib = 0;

        foreach ($this->worker as $key => $value) {
            # code...
            foreach ($value as $item) {
                # code...
                $this->items = $item;
                switch ($key) {
                    case '01':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '02':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '03':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '04':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                          $doing_er++;
                          $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                            $this->count_done_er =  $done_er;                           
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                            $this->count_doing_mf =  $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                           $done_mf++;
                           $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                            $this->count_doing_calib = $doing_calib;
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                            $this->count_done_calib = $done_calib;
                        }
                        break;
                    case '05':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '06':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '07':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '08':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '09':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '10':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '11':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    case '12':
                        # code...
                        if($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_er++;
                            $this->count_doing_er = $doing_er;
                        }elseif($item->getWorkOrder->job_type_id == 2 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_er++;
                             $this->count_done_er = $done_er;
                        }
                        if($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_mf++;
                             $this->count_doing_mf = $doing_mf;
                        }elseif($item->getWorkOrder->job_type_id == 1 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                             $done_mf++;
                             $this->count_done_mf = $done_mf;
                        }
                        if($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 4  && $item->getWorkOrder->work_order_start_id != null){
                            $doing_calib++;
                             $this->count_doing_calib = $doing_calib; 
                        }elseif($item->getWorkOrder->job_type_id == 3 && $item->getWorkOrder->status == 9 && $item->getWorkOrder->work_order_start_id != null){
                            $done_calib++;
                             $this->count_done_calib = $done_calib; 
                        }
                        break;
                    default:
                        # code...
                        break;
                }
            }
          
        }
    }

   

    public function printPdf()
    {
        if($this->date_year == null) {
            $year = Carbon::now()->format('Y');
            $this->date_year = $year;
        }else{
            $year = $this->date_year;
        }            
           
        $total_er_started = 0;
        $total_er_on_time = 0;
        $total_delayed_man = 0;
        $total_started_mf = 0;
        $total_on_time_mf = 0;
        $total_delayed_man_mf = 0;
        $total_started_calib = 0;
        $total_on_time_calib = 0;
        $total_delayed_man_calib = 0;
        if(!empty($this->delayed_reason_id && $this->date_finished_id)) {     
   
            if(!empty($this->items)) {
                //FOR ER
                if ($this->count_doing_er != 0 && $this->count_done_er != 0) {
                    $done_doing_er  = $this->count_doing_er + $this->count_done_er;
                    $deduct_started_on_time =  $done_doing_er - $this->count_done_er;
                    $calculate_delayed_percentage_er = $deduct_started_on_time/ $done_doing_er * 100;
                    $calculate_on_time_percentage_er = 100-$calculate_delayed_percentage_er;

                    //total
                    $total_er_started += $done_doing_er + $this->count_done_er;    
                    $total_er_on_time += $this->count_done_er;
                    $total_delayed_man += $deduct_started_on_time;

                    //calculate total
                    $calculate_total_delayed_percentage_er = $total_delayed_man/$total_er_started*100;
                    $calculate_total_on_time_percentage_er = 100-$calculate_total_delayed_percentage_er;
        
                    $this->calculate_delayed_percentage_er_id = $calculate_delayed_percentage_er;
                    $this->calculate_on_time_percentage_er_id = $calculate_on_time_percentage_er;

                    //calculated total              
                    $this->calculate_total_on_time_percentage_er_id = $calculate_total_on_time_percentage_er;
                    $this->calculate_total_delayed_percentage_er_id = $calculate_total_delayed_percentage_er;
                    $this->total_delayed_er_id = $total_delayed_man;    
                    $this->delayed_er_id = $deduct_started_on_time;
                }

                //FOR MF
                if ($this->count_doing_mf != 0 && $this->count_done_mf != 0) {
                    $done_doing_mf  = $this->count_doing_mf + $this->count_done_mf;
                    $deduct_started_on_time_mf =  $done_doing_mf - $this->count_done_mf;
                    $calculate_delayed_percentage_mf = $deduct_started_on_time_mf/$done_doing_mf * 100;
                    $calculate_on_time_percentage_mf = 100-$calculate_delayed_percentage_mf;

                    //total
                    $total_started_mf += $done_doing_mf + $this->count_done_mf;
                    $total_on_time_mf += $this->count_done_mf; 
                    $total_delayed_man_mf += $deduct_started_on_time_mf;               

                    //calculate total
                    $calculate_total_delayed_percentage_mf = $total_delayed_man_mf/$total_started_mf*100;
                    $calculate_total_on_time_percentage_mf = 100-$calculate_total_delayed_percentage_mf;

                    $this->calculate_delayed_percentage_mf_id = $calculate_delayed_percentage_mf;
                    $this->calculate_on_time_percentage_mf_id = $calculate_on_time_percentage_mf;

                    //calculated total              
                    $this->calculate_total_on_time_percentage_mf_id = $calculate_total_on_time_percentage_mf;
                    $this->calculate_total_delayed_percentage_mf_id = $calculate_total_delayed_percentage_mf;
                    $this->total_delayed_mf_id = $total_delayed_man_mf;    
                    $this->delayed_mf_id = $deduct_started_on_time_mf;
                }

                //FOR CALIB
                if ( $this->count_doing_calib != 0 &&  $this->count_done_calib != 0) {
                    $done_doing_calib  = $this->count_doing_calib + $this->count_done_calib;
                    $deduct_started_on_time_calib =  $done_doing_calib - $this->count_done_calib;              
                    $calculate_delayed_percentage_calib = $deduct_started_on_time_calib/$done_doing_calib * 100;
                    $calculate_on_time_percentage_calib = 100-$calculate_delayed_percentage_calib;
    
                    //total
                    $total_started_calib += $done_doing_calib + $this->count_done_calib; 
                    $total_on_time_calib += $this->count_done_calib;  
                    $total_delayed_man_calib += $deduct_started_on_time_calib;               

                    //calculate total
                    $calculate_total_delayed_percentage_calib = $total_delayed_man_calib/$total_started_calib*100;
                    $calculate_total_on_time_percentage_calib = 100-$calculate_total_delayed_percentage_calib;

                    $this->calculate_delayed_percentage_calib_id = $calculate_delayed_percentage_calib;
                    $this->calculate_on_time_percentage_calib_id = $calculate_on_time_percentage_calib; 

                    //calculated total              
                    $this->calculate_total_on_time_percentage_calib_id = $calculate_total_on_time_percentage_calib;
                    $this->calculate_total_delayed_percentage_calib_id = $calculate_total_delayed_percentage_calib;
                    $this->total_delayed_calib_id = $total_delayed_man_calib;    
                    $this->delayed_calib_id = $deduct_started_on_time_calib;
                }
            }
        }   

        $pdf  = PDF::loadView('livewire.prints.monthly-complience-report', [ 
            'monthly_complience' => AddWorker::with('getWorkOrder')->whereNotNull(['start']) 
            ->when($this->date_year, function ($query) {
                $query->whereYear('created_at','=',$this->date_year);              
            })->get()->groupBy(function ($item) {
                return $item->start->format('m');
            }),
            'year'               => $year,
            'delayed_reason_id'  => $this->delayed_reason_id,
            'calculate_delayed_percentage_er_id' => $this->calculate_delayed_percentage_er_id ,
            'calculate_on_time_percentage_er_id' => $this->calculate_on_time_percentage_er_id ,          
            'calculate_total_on_time_percentage_er_id' => $this->calculate_total_on_time_percentage_er_id ,
            'calculate_total_delayed_percentage_er_id' => $this->calculate_total_delayed_percentage_er_id ,
            'total_delayed_er_id' => $this->total_delayed_er_id,
            'delayed_er_id' => $this->delayed_er_id,        //ER
            'calculate_delayed_percentage_mf_id' => $this->calculate_delayed_percentage_mf_id ,
            'calculate_on_time_percentage_mf_id' => $this->calculate_on_time_percentage_mf_id ,          
            'calculate_total_on_time_percentage_mf_id' => $this->calculate_total_on_time_percentage_mf_id ,
            'calculate_total_delayed_percentage_mf_id' => $this->calculate_total_delayed_percentage_mf_id ,
            'total_delayed_mf_id' => $this->total_delayed_mf_id,
            'delayed_mf_id' => $this->delayed_mf_id ,      //MF
            'calculate_delayed_percentage_calib_id' => $this->calculate_delayed_percentage_calib_id ,
            'calculate_on_time_percentage_calib_id' => $this->calculate_on_time_percentage_calib_id ,          
            'calculate_total_on_time_percentage_calib_id' => $this->calculate_total_on_time_percentage_calib_id ,
            'calculate_total_delayed_percentage_calib_id' => $this->calculate_total_delayed_percentage_calib_id ,
            'total_delayed_calib_id' => $this->total_delayed_calib_id,
            'delayed_calib_id' => $this->delayed_calib_id  //CALIB
            
        ])->setPaper('A4','landscape')->output(); 

        return response()->streamDownload(
            fn () => print($pdf),"monthly-complience-report.pdf"
        );     
    }

    public function render()
    {
        if($this->date_year == null) {
            $year = Carbon::now()->format('Y');
            $this->date_year = $year;
        }else{
            $year = $this->date_year;
        }

        $job_order = JobOrder::with('getWorkOrder')
        ->whereIn('status',[9,4])
        ->get()
        ->groupBy(function ($item) {
            return $item->date->format('m');
        });
        // ->toArray();
        // dd($job_order);
        $job_order->each(function($values,$key){
            if($key==3){
                // dd($values);
                $values->flatten()
                ->filter(function($value, $keys) {
                
         $value->where('status',4)->count();               
                });                
                // dd($values);
            }
            if($key==4){
                $values->flatten()->filter(function($value, $keys) {                
                    return $value = 4;
                // dd($value->count());
                });                
            }
         });   

        //  $done_doing_er = 0;
         $total_er_started = 0;
         $total_er_on_time = 0;
         $total_delayed_man = 0;
         $total_started_mf = 0;
         $total_on_time_mf = 0;
         $total_delayed_man_mf = 0;
         $total_started_calib = 0;
         $total_on_time_calib = 0;
         $total_delayed_man_calib = 0;
         if(!empty($this->delayed_reason_id && $this->date_finished_id)) {     
       
             if(!empty($this->items)) {
                 //FOR ER
                 if ($this->count_doing_er != 0 && $this->count_done_er != 0) {
                     $done_doing_er  = $this->count_doing_er + $this->count_done_er;
                     $deduct_started_on_time =  $done_doing_er - $this->count_done_er;
                     $calculate_delayed_percentage_er = $deduct_started_on_time/ $done_doing_er * 100;
                     $calculate_on_time_percentage_er = 100-$calculate_delayed_percentage_er;

                     //total
                     $total_er_started += $done_doing_er + $this->count_done_er;    
                     $total_er_on_time += $this->count_done_er;
                     $total_delayed_man += $deduct_started_on_time;

                     //calculate total
                     $calculate_total_delayed_percentage_er = $total_delayed_man/$total_er_started*100;
                     $calculate_total_on_time_percentage_er = 100-$calculate_total_delayed_percentage_er;
         
                     $this->calculate_delayed_percentage_er_id = $calculate_delayed_percentage_er;
                     $this->calculate_on_time_percentage_er_id = $calculate_on_time_percentage_er;

                     //calculated total              
                     $this->calculate_total_on_time_percentage_er_id = $calculate_total_on_time_percentage_er;
                     $this->calculate_total_delayed_percentage_er_id = $calculate_total_delayed_percentage_er;
                     $this->total_delayed_er_id = $total_delayed_man;    
                     $this->delayed_er_id = $deduct_started_on_time;
                 }

                 //FOR MF
                 if ($this->count_doing_mf != 0 && $this->count_done_mf != 0) {
                     $done_doing_mf  = $this->count_doing_mf + $this->count_done_mf;
                     $deduct_started_on_time_mf =  $done_doing_mf - $this->count_done_mf;
                     $calculate_delayed_percentage_mf = $deduct_started_on_time_mf/$done_doing_mf * 100;
                     $calculate_on_time_percentage_mf = 100-$calculate_delayed_percentage_mf;

                     //total
                     $total_started_mf += $done_doing_mf + $this->count_done_mf;
                     $total_on_time_mf += $this->count_done_mf; 
                     $total_delayed_man_mf += $deduct_started_on_time_mf;               

                     //calculate total
                     $calculate_total_delayed_percentage_mf = $total_delayed_man_mf/$total_started_mf*100;
                     $calculate_total_on_time_percentage_mf = 100-$calculate_total_delayed_percentage_mf;

                     $this->calculate_delayed_percentage_mf_id = $calculate_delayed_percentage_mf;
                     $this->calculate_on_time_percentage_mf_id = $calculate_on_time_percentage_mf;

                     //calculated total              
                     $this->calculate_total_on_time_percentage_mf_id = $calculate_total_on_time_percentage_mf;
                     $this->calculate_total_delayed_percentage_mf_id = $calculate_total_delayed_percentage_mf;
                     $this->total_delayed_mf_id = $total_delayed_man_mf;    
                     $this->delayed_mf_id = $deduct_started_on_time_mf;
                 }

                 //FOR CALIB
                 if ( $this->count_doing_calib != 0 &&  $this->count_done_calib != 0) {
                     $done_doing_calib  = $this->count_doing_calib + $this->count_done_calib;
                     $deduct_started_on_time_calib =  $done_doing_calib - $this->count_done_calib;              
                     $calculate_delayed_percentage_calib = $deduct_started_on_time_calib/$done_doing_calib * 100;
                     $calculate_on_time_percentage_calib = 100-$calculate_delayed_percentage_calib;
     
                     //total
                     $total_started_calib += $done_doing_calib + $this->count_done_calib; 
                     $total_on_time_calib += $this->count_done_calib;  
                     $total_delayed_man_calib += $deduct_started_on_time_calib;               

                     //calculate total
                     $calculate_total_delayed_percentage_calib = $total_delayed_man_calib/$total_started_calib*100;
                     $calculate_total_on_time_percentage_calib = 100-$calculate_total_delayed_percentage_calib;

                     $this->calculate_delayed_percentage_calib_id = $calculate_delayed_percentage_calib;
                     $this->calculate_on_time_percentage_calib_id = $calculate_on_time_percentage_calib; 

                     //calculated total              
                     $this->calculate_total_on_time_percentage_calib_id = $calculate_total_on_time_percentage_calib;
                     $this->calculate_total_delayed_percentage_calib_id = $calculate_total_delayed_percentage_calib;
                     $this->total_delayed_calib_id = $total_delayed_man_calib;    
                     $this->delayed_calib_id = $deduct_started_on_time_calib;
                 }
             }
         }   
       
        return view('livewire.report.monthly-complience-report-table',[
          
            //pass data manually
            'monthly_complience' => AddWorker::with('getWorkOrder')->whereNotNull(['start']) 
            ->when($this->date_year, function ($query) {
                $query->whereYear('created_at','=',$this->date_year);              
            })->get()->groupBy(function ($item) {
                return $item->start->format('m');
            }),
            'year'               => $year,
            'delayed_reason_id'  => $this->delayed_reason_id,
            'calculate_delayed_percentage_er_id' => $this->calculate_delayed_percentage_er_id ,
            'calculate_on_time_percentage_er_id' => $this->calculate_on_time_percentage_er_id ,          
            'calculate_total_on_time_percentage_er_id' => $this->calculate_total_on_time_percentage_er_id ,
            'calculate_total_delayed_percentage_er_id' => $this->calculate_total_delayed_percentage_er_id ,
            'total_delayed_er_id' => $this->total_delayed_er_id,
            'delayed_er_id' => $this->delayed_er_id,        //ER
            'calculate_delayed_percentage_mf_id' => $this->calculate_delayed_percentage_mf_id ,
            'calculate_on_time_percentage_mf_id' => $this->calculate_on_time_percentage_mf_id ,          
            'calculate_total_on_time_percentage_mf_id' => $this->calculate_total_on_time_percentage_mf_id ,
            'calculate_total_delayed_percentage_mf_id' => $this->calculate_total_delayed_percentage_mf_id ,
            'total_delayed_mf_id' => $this->total_delayed_mf_id,
            'delayed_mf_id' => $this->delayed_mf_id ,      //MF
            'calculate_delayed_percentage_calib_id' => $this->calculate_delayed_percentage_calib_id ,
            'calculate_on_time_percentage_calib_id' => $this->calculate_on_time_percentage_calib_id ,          
            'calculate_total_on_time_percentage_calib_id' => $this->calculate_total_on_time_percentage_calib_id ,
            'calculate_total_delayed_percentage_calib_id' => $this->calculate_total_delayed_percentage_calib_id ,
            'total_delayed_calib_id' => $this->total_delayed_calib_id,
            'delayed_calib_id' => $this->delayed_calib_id  //CALIB
        ]);

    }
}
