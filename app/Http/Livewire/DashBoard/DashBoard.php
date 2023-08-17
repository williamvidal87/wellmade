<?php

namespace App\Http\Livewire\DashBoard;

use App\Models\CalibrationWOrkOrder; //From CalibrationWorkOrder to CalibrationWOrkOrder
use Livewire\Component;
use App\Models\JobOrder;
use App\Models\ClientProfile;
use App\Models\ErWorkOrder;
use App\Models\StockManagement;
use App\Models\WorkOrder;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
class DashBoard extends Component
{
    use WithPagination;

    public $job_orders, $mf_work_order, $er_work_order, $callib_work_order;
    public $no_clients,$monthly_added_clients = 0, $client_word;
    public $no_months = array(
        "Jan"=>0,"Feb"=>0,"Mar"=>0,"Apr"=>0,"May"=>0,
        "Jun"=>0,"Jul"=>0,"Aug"=>0,"Sept"=>0,"Oct"=>0,
        "Nov"=>0,"Dec"=>0
    );
    public $jb_pending, $jb_processing, $jb_done;
    public $mf_doing, $mf_done, $mf_approval;
    public $er_doing, $er_done, $er_approval;
    public $calib_doing, $calib_done, $calib_approval;

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function mount(){

        $this->jb_pending = count(JobOrder::where('status',1)->get());
        $this->jb_processing = count(JobOrder::where('status',4)->get());
        $this->jb_done = count(JobOrder::where('status',9)->get());

        $this->mf_doing = count(
            WorkOrder::where('job_type_id',1)
                      ->where('status', 5)
                      ->get()
        );

        $this->mf_done = count(
            WorkOrder::where('job_type_id',1)
                      ->where('status', 9)
                      ->get()
        );
        $this->mf_approval = count(
            WorkOrder::where('job_type_id',1)
                      ->where('status', 6)
                      ->get()
        );

        $this->er_doing = count(
            WorkOrder::where('job_type_id',2)
                      ->where('status', 5)
                      ->get()
        );

        $this->er_done = count(
            WorkOrder::where('job_type_id',2)
                      ->where('status', 9)
                      ->get()
        );
        $this->er_approval = count(
            WorkOrder::where('job_type_id',2)
                      ->where('status', 6)
                      ->get()
        );

        $this->calib_doing = count(
            WorkOrder::where('job_type_id',3)
                      ->where('status', 5)
                      ->get()
        );

        $this->calib_done = count(
            WorkOrder::where('job_type_id',3)
                      ->where('status', 9)
                      ->get()
        );
        $this->calib_approval = count(
            WorkOrder::where('job_type_id',3)
                      ->where('status', 6)
                      ->get()
        );

        $job_orders = JobOrder::all();
        $this->job_orders = count($job_orders);

        $no_clients = ClientProfile::all()->sortBy('id');
        $this->no_clients = count($no_clients);
        $work_orders = count(WorkOrder::all());
        $this->mf_work_order = count(WorkOrder::where('job_type_id', 1)->get());
        $this->er_work_order = count(WorkOrder::where('job_type_id', 2)->get());
        $this->callib_work_order = count(WorkOrder::where('job_type_id', 3)->get());

        $this->monthlyAdded($no_clients);
    }

    public function monthlyAdded($data){
        $current_month = date("m");
        $current_year = date("Y");
        foreach($data as $value){
            $month_data = $value->created_at->format("m");
            $year_data = $value->created_at->format("Y");
            if($current_year == $year_data && $month_data == $current_month){
                $this->monthly_added_clients++;
            }
        }
        if($this->monthly_added_clients == 1){
            $this->client_word = "Client";
        }else{
            $this->client_word = "Clients";
        }
    }

    public function render()
    {
        $current_year = date("Y");
        $dates = JobOrder::where('status',9)->pluck('created_at');
        // $dates = JobOrder::whereIn('status',[1,4,9])->pluck('created_at');
        // $dates = DB::table('job_orders')->pluck('created_at');
        foreach($dates as $value){
            $data_year = substr($value,0,4);
            $data_date = substr($value,5,-12);
            if($data_year == $current_year){
                if($data_date == "01" || $data_date == "1"){
                    $this->no_months["Jan"]++;
                }else if($data_date == "02" || $data_date == "2"){
                    $this->no_months["Feb"]++;
                }else if($data_date == "03" || $data_date == "3"){
                    $this->no_months["Mar"]++;
                }else if($data_date == "04" || $data_date == "4"){
                    $this->no_months["Apr"]++;
                }else if($data_date == "05" || $data_date == "5"){
                    $this->no_months["May"]++;
                }else if($data_date == "06" || $data_date == "6"){
                    $this->no_months["Jun"]++;
                }else if($data_date == "07" || $data_date == "7"){
                    $this->no_months["Jul"]++;
                }else if($data_date == "08" || $data_date == "8"){
                    $this->no_months["Aug"]++;
                }else if($data_date == "09" || $data_date == "9"){
                    $this->no_months["Sept"]++;
                }else if($data_date == "10"){
                    $this->no_months["Oct"]++;
                }else if($data_date == "11"){
                    $this->no_months["Nov"]++;
                }else{
                    $this->no_months["Dec"]++;
                }
            }
        }
        return view('livewire.dash-board.dash-board',[
            'clients'=> ClientProfile::all()->sortByDesc('id')->take(10),
            'graph_datas'=> $this->no_months,
            'stockManagements' => StockManagement::with('suppliers')->whereIn('REP', [1,2])->get(),
        ]);
    }
}
