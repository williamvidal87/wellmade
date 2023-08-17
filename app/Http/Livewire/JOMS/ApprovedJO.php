<?php

namespace App\Http\Livewire\JOMS;

use App\Models\AddWorker;
use App\Models\InvoiceTypes;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\JobOrder;
use App\Models\SbTransaction;
use App\Models\TransactionSummary;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\WorkOrder;
use App\Models\WvTransaction;
use Illuminate\Support\Carbon;

class ApprovedJO extends Component
{
    use WithPagination;
    public $wv = [0,0,0,0,0];
    public $work_orders_of_jo = [];
    public $all_work_orders, $work_types_jos = [];
    public $all_work_types = [];
    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteJobOrder'
    ];

    public function deleteJobOrder($joborderID)
    {
        JobOrder::destroy($joborderID);
        $this->reset();
    }

    public function journalize($id)
    {
        $this->emit('openJournalizeModal');

        $lastSbId = SbTransaction::latest('id')->first();
        $lastWvId = WvTransaction::latest('id')->first();
        $invoice_types = InvoiceTypes::all();
        $newNumber = [];
        if ($lastSbId == null && $lastWvId == null) {
            $invoice_no = '-' . str_pad(1, 5, '0', STR_PAD_LEFT);

            foreach ($invoice_types as $value) {
                if($value->invoice_type == "SB" || $value->invoice_type == "WV"){
                    $newNumber[$value->invoice_type.$invoice_no] = $value->invoice_type.$invoice_no;
                }
            }

        } elseif($lastSbId == null && $lastWvId != null){
            $sbInvoice_no = '-' . str_pad(1, 5, '0', STR_PAD_LEFT);
            $wvInvoice_no = '-' . str_pad(++$lastWvId->id, 5, '0', STR_PAD_LEFT);

            foreach ($invoice_types as $value) {
                if($value->invoice_type == "SB"){
                    $newNumber[$value->invoice_type.$sbInvoice_no] = $value->invoice_type.$sbInvoice_no;
                }else if($value->invoice_type == "WV"){
                    $newNumber[$value->invoice_type.$wvInvoice_no] = $value->invoice_type.$wvInvoice_no;
                }
            }

        } elseif($lastSbId != null && $lastWvId == null){
            $sbInvoice_no = '-' . str_pad(++$lastSbId->id, 5, '0', STR_PAD_LEFT);
            $wvInvoice_no = '-' . str_pad(1, 5, '0', STR_PAD_LEFT);

            foreach ($invoice_types as $value) {
                if($value->invoice_type == "SB"){
                    $newNumber[$value->invoice_type.$sbInvoice_no] = $value->invoice_type.$sbInvoice_no;
                }else if($value->invoice_type == "WV"){
                    $newNumber[$value->invoice_type.$wvInvoice_no] = $value->invoice_type.$wvInvoice_no;
                }
            }

        }else {
            $sbInvoice_no = '-' . str_pad(++$lastSbId->id, 5, '0', STR_PAD_LEFT);
            $wvInvoice_no = '-' . str_pad(++$lastWvId->id, 5, '0', STR_PAD_LEFT);

            foreach ($invoice_types as $value) {
                if($value->invoice_type == "SB"){
                    $newNumber[$value->invoice_type.$sbInvoice_no] = $value->invoice_type.$sbInvoice_no;
                }else if($value->invoice_type == "WV"){
                    $newNumber[$value->invoice_type.$wvInvoice_no] = $value->invoice_type.$wvInvoice_no;
                }
            }

        }

        $forDefaultValue = 2;
        $this->emit('serviceInvoiceNumber', $newNumber, $forDefaultValue);
        $this->emit('serviceInvoiceDate', Carbon::today());
        $this->emit('jobOrderNumber', $id);
    }
    
    public function editRecord($data){
        $this->emit('approvedJO', $data);
        $this->emit('openApprovedJobOrderModal');
    }
    public function render()
    {
        $work_types = [];
        if($this->work_types_jos){
            $this->work_types_jos = [];
        }
        $approved_jos = JobOrder::where('status', 9)->get()->sortBy('id');
        foreach($approved_jos as $key=>$data){
            $work_order = WorkOrder::where('jo_no_id',$data->id)->get();
            array_push($this->work_types_jos, $work_order);
        }
        foreach($this->work_types_jos as $records){
            foreach($records as $record){
                if($record->mf_work_group_id){
                    $check = in_array("MF",$work_types);
                    if($check !== true){
                        array_push($work_types, "MF");
                    }
                }elseif($record->er_work_group_id){
                    $check = in_array("ER",$work_types);
                    if($check !== true){
                        array_push($work_types, "ER");
                    }
                }else{
                    $check = in_array("CALIB",$work_types);
                    if($check !== true){
                        array_push($work_types, "CALIB");
                    }
                }
            }

            array_push($this->all_work_types, $work_types);
            $work_types = [];
            
        }
        return view('livewire.j-o-m-s.approved-j-o', [
            'approved_jo'=> $approved_jos,
        ]);

    }
    public function deleteConfirmJobOrder($id){
        $this->dispatchBrowserEvent('swal:confirmJobOrderDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $id
        ]);
    }

    // public function export2PDF($dataID){
    //     $job_order_data = JobOrder::where('id',$dataID)->first();
    //     $latestID = JobOrder::latest('id')->where('status',2)->first();
    //     $related_work_order = WorkOrder::where('jo_no_id',$job_order_data->id)->get();
    //     // $jo_data = JobOrder::where('id',$data->jo_no_id)->first();
    //     $compute = [];
    //     foreach($related_work_order as $data){
    //         $count = $data->price * $data->qty;
    //         array_push($compute, $count);
    //     }
    //     if(count($compute) > 1){
    //         $total_amount = array_sum($compute);
    //     }else{
    //         $total_amount = $compute[0];
    //     }

    //     $wv = str_pad(0, 5, '0', STR_PAD_LEFT);
    //     --$latestID->id;
    //     ++$latestID->id;
    //     $wv = str_pad($latestID->id, 5, '0', STR_PAD_LEFT);

    //     $records = array(
    //         'data'=> $job_order_data,
    //         'related_work_order'=>$related_work_order,
    //         'total_amount'=>$total_amount,
    //         'wv'=>$wv
    //     );
        
    //     if($data->mf_work_group_id){
    //         $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records])->output();
    //         return response()->streamDownload(
    //         fn () => print($pdfContent),
    //         "Machining-and-Fabrication.pdf"
    //         );
    //     }elseif($data->calib_work_group_id){
    //         $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records])->output();
    //         return response()->streamDownload(
    //         fn () => print($pdfContent),
    //         "Calibration.pdf"
    //         );
    //     }else{
    //         $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records])->output();
    //         return response()->streamDownload(
    //         fn () => print($pdfContent),
    //         "Engine-Reconditioning.pdf"
    //         );
    //     }

    // }
}
