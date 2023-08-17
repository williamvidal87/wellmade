<?php

namespace App\Http\Livewire\PrintWorkOrder;

use App\Models\AddWorker;
use Livewire\Component;
use App\Models\JobOrder;
use App\Models\WorkOrder;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use DatePeriod;

class WorkOrderPrint extends Component
{
    public $scannedID, $work_order, $operator, $jo, $operator_id, $match;
    public $count=0, $proceed_working, $count_down=5, $encoder, $work_order_id, $worker;
    public $disable_inputs = false, $rescanq = false, $status, $total_time, $error_caught = false;

    protected $listeners = [
        'countdown',
        'rescanagain',
    ];


    public function countdown($val){

        $this->count_down = $val;
        $this->disable_inputs = false;
        if($this->proceed_working == "rescanq"){

            $this->proceed_working = null;

            if($this->scannedID){

                $this->scannedID = null;
            }
        }

        if($this->match == "fwo"){

            $this->match == null;
        }
        $this->reset();
        // $CARBON_TIME = Carbon::now('Asia/Manila');
        // $CURRENT_TIME = $CARBON_TIME->format('g:i A');
        // $END_TIME = strtotime("+6 minutes", strtotime($CARBON_TIME));
        // $date = date('d-m-Y H:i', strtotime("+5 min"));
    }

    public function checkrescanE($worker_ID, $work_order_id){

        $worker = AddWorker::where('assigned_worker_id', $worker_ID)
        ->where('work_order_id', $work_order_id)
        ->first();

        if($worker->start && is_null($worker->end)){

            $worker_time = $worker->start->format('Y-m-d h:i');
            $start_time = new DateTime($worker_time);
            $current_date = Carbon::now()->format('Y-m-d h:i');
            $current_datetime = new DateTime($current_date);
            $interval = $start_time->diff($current_datetime);
            $diffInMinutes = $interval->i;
            $diffIndays = $interval->d;
            $diffInhours = $interval->h;
            $time_gap = 5;
            
            if($diffInMinutes < $time_gap){

                $this->rescanq = true;
                $this->proceed_working = "rescanq";

            }

            if($diffIndays >= 1 || $diffInhours >= 1){

                $this->proceed_working = "proceed true";
            }
        }

    }

    public function actionButton($val){

        if($val == 'pause'){

            $worker = AddWorker::where('assigned_worker_id', $this->operator_id)
                                ->where('work_order_id', $this->work_order_id)
                                ->first();
            $workorder = WorkOrder::find($this->work_order_id);
            if($worker->start && is_null($worker->end)){

                $worker->status = 15;
                $worker->pause = Carbon::now('Asia/Manila')->format('Y-m-d h:i');
                $worker->save();

                if($workorder->work_order_start_id && is_null($workorder->work_order_end_id)){

                    $workorder->status = 15;
                    $workorder->save();
                }

                $this->match = "pause";
            }
        }
    }

    //Finished Work Order cannot be scanned again
    public function checkWorkOrder($work_order_id, $worker_id){

        $worker = AddWorker::where('work_order_id', $work_order_id)
                            ->where('assigned_worker_id', $worker_id)
                            ->first();
        if($worker->start && $worker->end && $worker->status == 9){

            $this->match = "fwo";
        }
    }

    public function updatedScannedID(){

        $no_letters = preg_match("/[a-z]/i", $this->scannedID) == false;
        $minus_sign = preg_match('/[-]/', $this->scannedID) == true;
        $special_characters = preg_match('/[\'.:;^\/£$%&*!()}"\[\]{@#~?><>,|=_+¬]/', $this->scannedID) == false;
        $backslash = preg_match('/\\\\/', $this->scannedID) == false;
        $spaces = preg_match('/[\s]+/',$this->scannedID) == false;

        if($no_letters == false){
            // if($this->proceed_working){
            //     $this->proceed_working = null;
            // }
            $this->proceed_working = "error scan properly";
        }

        if (is_numeric($this->scannedID) && $minus_sign == false){
            if(is_null($this->operator_id) && is_null($this->work_order_id)){

                $no_letters = false;
            }
        }

        if(strlen($this->scannedID) == 1){

            if($special_characters == false || $minus_sign == true){
                $no_letters = false;
            }

            if($this->match == "fwo"){

                $no_letters = false;

            }
        }

        if ($this->disable_inputs == false && $spaces == true && $no_letters == true && $special_characters == true && $backslash == true) {

            try{

                // $check_cond1 = str_contains($this->scannedID, '-') == false;
                // strlen($this->scannedID) == 1
                if (is_numeric($this->scannedID) == true) {

                    $worker_id = $this->scannedID;
    
                } else {
                    
                    if($this->work_order_id){
    
                        $this->rescanq = true;
                        $this->match = "Invalid scanned Qr code";
    
                    }
    
                    $separator = strpos($this->scannedID, "-");
                    $work_order_id = substr($this->scannedID, 0, $separator);
                    $worker_id = substr($this->scannedID, ++$separator);
    
    
                }

            }catch (\Exception $e){

                $this->error_caught = true;
            }

            if ($this->rescanq == false && $this->error_caught == false) {
                $this->count++;
                $matchID=false;
                $this->encoder = auth()->user()->name;
                $carbon_current_date_time = Carbon::now('Asia/Manila')->format('Y-m-d h:i'); #Carbon::now('Asia/Manila')->format('Y-m-d h:i A')date('d-m-Y H:i');
                //read 2nd scan
                if ($this->match) {
                    $this->match = null;
                }

                // read 2nd scan
                if ($this->proceed_working) {
                    $this->proceed_working = null;
                }

                if ($this->operator_id) { //2nd scan

                    $matchID=true;
                } elseif (is_null($this->operator_id)) { //1st scan

                    $this->operator_id = $worker_id;
                    $this->work_order_id = $work_order_id;
                }

                // if statement for first scan
                if ($this->count !== 2) {

                    $this->worker = AddWorker::where('assigned_worker_id', $worker_id)
                                            ->where('work_order_id', $work_order_id)
                                            ->first();
                    $this->work_order = WorkOrder::where('id', $work_order_id)->first();
                    $this->jo = JobOrder::where('id', $this->work_order->jo_no_id)->first();

                    $cond1 = $this->work_order->status == 6 && $this->worker->status == 6;
                    $cond2 = $this->work_order->status == 5 && $this->worker->status == 6;

                    if ($cond1 || $cond2) {
                        $this->proceed_working = "cannot proceed";
                        $this->count = 0;

                        if ($this->operator_id) {
                            $this->operator_id = null;
                            $this->work_order_id = null;
                        }
                    }

                    if($this->worker->status == 15){

                        $this->match = "pause";
                    }

                }

                //strlen($this->scannedID) !== 1
                if(is_numeric($this->scannedID) == false){

                    $this->checkWorkOrder($work_order_id, $worker_id);
                }

                if ($matchID == true) {

                    $this->disable_inputs = true;
                    if ($this->operator_id == $worker_id) {

                        $this->match = "match";
                    
                        // Scan for START work-order

                        if (is_null($this->worker->start) && is_null($this->worker->end) && $this->worker->status == 5) {

                            $this->worker->update(array('start'=>$carbon_current_date_time));
            
                            if (is_null($this->work_order->work_order_start_id) && is_null($this->work_order->work_order_end_id)) {
                                $this->work_order->work_order_start_id = $this->worker->id;
                                $this->work_order->save();
                            }

                            // Scan for End work-order
                        } elseif ($this->worker->start && is_null($this->worker->end) && $this->worker->status == 5) {
                            
                            // check if the work-order is rescanned for END immeadiately
                            $this->checkrescanE($this->operator_id, $this->work_order_id);

                            if($this->proceed_working !== "rescanq" || $this->proceed_working == "proceed true"){

                                $this->worker->end = $carbon_current_date_time;
                                $this->worker->status = 9;
                                $this->worker->save();

                                $count_operators = 0;
                                $all_operators = $this->work_order->workers;

                                if(count($all_operators) == 1){

                                    if($this->worker->start && $this->worker->end && $this->worker->status == 9){

                                        $this->work_order->status = 9;
                                        $this->work_order->work_order_end_id = $this->worker->id;
                                        $this->work_order->save();
                                    }
                                }else{

                                    foreach ($all_operators as $data) {
                                        if ($data->id !== $this->worker->id) {
                                            if ($data->start && $data->end) {
                                                $count_operators++;
                                            }
                                        }
                                    }
                                    $total_operators = count($all_operators) - 1;
                                    if ($count_operators == $total_operators) {
                                        if ($this->work_order->work_order_start_id && is_null($this->work_order->work_order_end_id)) {
                                            $value = 9;
                                            $this->work_order->status = $value;
                                            $this->work_order->work_order_end_id = $this->worker->id;
                                            $this->work_order->save();
                                        }
                                    }
                                }

                                if (count($this->jo->WorkOrders) == count($this->jo->WorkOrders->where('status', 9))) {
                                    $this->jo->status = 9;
                                    $this->jo->save();
                                }
                            }

                        }elseif($this->worker->status == 15){

                            $this->match = "match r";
                            // $this->worker->start = Carbon::now('Asia/Manila')->format('Y-m-d h:i');
                            $this->worker->status = 5;
                            $this->worker->resume = Carbon::now('Asia/Manila')->format('Y-m-d h:i');
                            $this->worker->save();
                            $this->work_order->status = 5;
                            $this->work_order->save();


                        }
                    } elseif ($this->operator_id !== $this->scannedID) {
                        $this->match = "not match";
                        $this->operator_id = null;
                        $this->work_order_id = null;
                    }

                    $this->count = 0;
                    $this->operator_id = null;
                    $this->work_order_id = null;
                }
            } //end rescan e
        }

        $this->scannedID = null;
        // $worker_id = null;
    }

    public function render()
    {
        if($this->total_time){

            $this->total_time = null;
        }

        if(!is_null($this->worker)){

            if($this->worker->status == 15){

                $start_time = new DateTime($this->worker->start);
                $pause_time = new DateTime($this->worker->pause);
                $interval = $start_time->diff($pause_time);
                $diffInMinutes = $interval->i;
                $diffInHour = $interval->h;
                $diffInDays = $interval->d;
                $day = $diffInDays > 1 ? "days" : "day";
                $hour = $diffInHour > 1 ? "hours" : "hour";
                $min = $diffInMinutes > 1 ? "minutes" : "minute";
                $this->total_time = $diffInDays . ' ' . $day . ', '.  $diffInHour . ' ' . $hour . ' and ' . $diffInMinutes . ' ' . $min;

            }

            if($this->worker->start && is_null($this->worker->end) && $this->worker->status == 5){

                $start_time = new DateTime($this->worker->start->format('Y-m-d h:i'));
                $current_date = Carbon::now()->format('Y-m-d h:i');
                $current_datetime = new DateTime($current_date);
                $interval = $start_time->diff($current_datetime);
                $diffInMinutes = $interval->i;
                $diffInHour = $interval->h;
                $diffInDays = $interval->d;
                $day = $diffInDays > 1 ? "days" : "day";
                $hour = $diffInHour > 1 ? "hours" : "hour";
                $min = $diffInMinutes > 1 ? "minutes" : "minute";
                $this->total_time = $diffInDays . ' ' . $day . ', '.  $diffInHour . ' ' . $hour . ' and ' . $diffInMinutes . ' ' . $min;
            }

            if($this->worker->start && $this->worker->end){

                $start_time = new DateTime($this->worker->start->format('Y-m-d h:i'));
                $end_time = new DateTime($this->worker->end->format('Y-m-d h:i'));
                $interval = $start_time->diff($end_time);
                $diffInMinutes = $interval->i;
                $diffInHour = $interval->h;
                $diffInDays = $interval->d;
                $min = $diffInMinutes > 1 ? "minutes" : "minute";
                $day = $diffInDays > 1 ? "days" : "day";
                $hour = $diffInHour > 1 ? "hours" : "hour";
                $this->total_time = $diffInDays . ' ' . $day . ', '.  $diffInHour . ' ' . $hour . ' and ' . $diffInMinutes . ' ' . $min;
            }
        }

        return view('livewire.print-work-order.work-order-print'); 
    }

}
