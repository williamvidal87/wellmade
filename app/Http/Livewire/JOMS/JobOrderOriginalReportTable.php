<?php

namespace App\Http\Livewire\JOMS;

use App\Enums\ServiceInvoice;
use App\Models\Branch;
use App\Models\JobOrder;
use App\Models\RequestPart;
use App\Models\RequestTool;
use App\Models\TransactionSummary;
use App\Models\WorkOrder;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
class JobOrderOriginalReportTable extends Component
{

    protected $listeners = [
        'originalUnlockAccess',
        'duplicateUnlockAccess',
        'triplicateUnlockAccess',
    ];

    public function originalUnlockAccess($id){
        JobOrder::where('id', $id)->update([
            'printed_original' => 0
        ]);
    }

    public function originalApproveUnlockAccess($dataID)
    {
        $this->dispatchBrowserEvent('swal:confirmOriginalUnlockAccess', [
            'title' => 'Are you sure to unlock?',
            'text' => "You won't be able to revert this!",
            'icon' => 'info',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, approve it!',
            'id' => $dataID
        ]);
    }

    public function duplicateUnlockAccess($id){
        JobOrder::where('id', $id)->update([
            'printed_duplicate' => 0
        ]);
    }

    public function duplicateApproveUnlockAccess($dataID)
    {
        $this->dispatchBrowserEvent('swal:confirmDuplicateUnlockAccess', [
            'title' => 'Are you sure to unlock?',
            'text' => "You won't be able to revert this!",
            'icon' => 'info',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, approve it!',
            'id' => $dataID
        ]);
    }

    public function triplicateUnlockAccess($id){
        JobOrder::where('id', $id)->update([
            'printed_triplicate' => 0
        ]);
    }

    public function triplicateApproveUnlockAccess($dataID)
    {
        $this->dispatchBrowserEvent('swal:confirmTriplicateUnlockAccess', [
            'title' => 'Are you sure to unlock?',
            'text' => "You won't be able to revert this!",
            'icon' => 'info',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, approve it!',
            'id' => $dataID
        ]);
    }

    public function checkRole()
    {
        $roles = [];
        $userrole = auth()->user()->roles;

        foreach ($userrole as $key => $value) {
            $roles[] = $value->name;
        }

        if (in_array("Admin", $roles)) {
            return true;
        }elseif(in_array("Super Admin", $roles)){
            return true;
        }else{
            return false;
        }
    }

    public function checkAbleToPrint()
    {
        $roles = [];
        $userrole = auth()->user()->roles;

        foreach ($userrole as $key => $value) {
            $roles[] = $value->name;
        }

        if (in_array("Encoder", $roles)) {
            return true;
        }else{
            return false;
        }
    }

    public function originalExport2PDF($dataID){
        $job_order_data = JobOrder::with('clientProfile.contacts', 'clientProfile.forCSA', 'getContact', 'getJobOrderTransaction')->where('id',$dataID)->whereIn('status', [1,2,3,4,9])->whereIn('payment_status_id', [12, 13])->first();
        $latestID = JobOrder::where('status',9)->where('payment_status_id', 12)->count();
        $related_work_order = WorkOrder::with('getERScope','getScopeDescription', 'getDiscount', 'getGeneralProcedure', 'getJobType')->where('jo_no_id',$job_order_data->id)->whereIn('status', [5,6,9])->get()->groupBy('getJobType.abbriv_code');
        $business_info = Branch::where('id', 1)->first();
        $remarks = TransactionSummary::with('getRemarks')->where('transaction_type_id', ServiceInvoice::SERVICE_INVOICE)->where('jo_no', $dataID)->first();
        
        // Get the parts
        // $request_part = RequestPart::with('getRequestTool.requestToolsData.getStockManagment')->where('jo_no_id', $dataID)->first();
        $request_part = RequestTool::with('requestToolsData.getStockManagment')
        ->where('jo_no_id', $dataID)
        ->where('status_id', 2)
        ->get();

        $overall_part_total = 0;
        if(!empty($request_part)){
            // foreach ($request_part->getRequestTool->requestToolsData as $value){
            //     $overall_part_total += $value->qty * $value->selling_price;
            // }
            foreach ($request_part as $request) {
                foreach ($request->requestToolsData as $tools) {
                    $overall_part_total += $tools->qty * $tools->selling_price;
                }
            }
        }

        // if(count($related_work_order) < 1){
        //     $related_work_order = WorkOrder::with('getERScope','getScopeDescription', 'getDiscount', 'getGeneralProcedure')->where('jo_no_id',$job_order_data->id)->where('status', null)->get();
        // }

        if (count($related_work_order) > 0) {

            $total_amount = 0;
            foreach ($related_work_order as $datas) {
                foreach ($datas as $data) {
                    if($data->status != 3){
                        if($data->max_discount == 0){
                            $data->max_discount == 1;
                            $output = 0;
                        }else{
                            // $output = (($data->price + $data->amount_increase) * $data->qty) / $data->max_discount;
                            $output=(($data->price+$data->amount_increase) * $data->qty)*($data->max_discount/100);
                        }
    
                        $total = (($data->price+$data->amount_increase) * $data->qty) - $output;
                        $total_amount += $total;
                    }
                }
            }

            if(!empty($request_part)){
                $total_amount += $overall_part_total;
            }

            if($this->checkAbleToPrint()){
                // Update the printed_original
                JobOrder::where('id', $dataID)->update([
                    'printed_original' => 1
                ]);
            }
    
            $wv = str_pad($latestID, 5, '0', STR_PAD_LEFT);
    
            $records = array(
                'data'=> $job_order_data,
                'related_work_order'=>$related_work_order,
                'total_amount'=>$total_amount,
                'wv'=>$wv,
                'type' => 'original',
                'remarks' => $remarks,
                'request_part' => $request_part,
            );
            
            $exist = [];
            foreach ($related_work_order as $key => $values) {
                foreach ($values as $value) {
                    if($value->mf_work_group_id && $value->mf_work_sub_type_id){
                        $exist['mf'] = true;
                    }elseif($value->er_work_group_id && $value->scopes_id){
                        $exist['er'] = true;
                    }elseif($value->calib_work_group_id && $value->calib_work_sub_type_id){
                        $exist['calib'] = true;
                    }
                }
            }
            
            if(isset($exist['mf']) && isset($exist['er']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&ER&CALIB.pdf"
                );
            }else if(isset($exist['mf']) && isset($exist['er'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&ER.pdf"
                );
            }else if(isset($exist['mf']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&CALIB.pdf"
                );
            }else if(isset($exist['er']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "ER&CALIB.pdf"
                );
            }else if(isset($exist['mf'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF.pdf"
                );
            } else if(isset($exist['er'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "ER.pdf"
                );
            } else if(isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "CALIB.pdf"
                );
            }
        }elseif (count($related_work_order) == 0 && $overall_part_total > 0){
            $total_amount = 0;

            if(!empty($request_part)){
                $total_amount += $overall_part_total;
            }

            if($this->checkAbleToPrint()){
                // Update the printed_original
                JobOrder::where('id', $dataID)->update([
                    'printed_original' => 1
                ]);
            }

            $wv = $wv = str_pad($latestID, 5, '0', STR_PAD_LEFT);

            $records = array(
                'data'=> $job_order_data,
                'related_work_order'=>$related_work_order,
                'total_amount'=>$total_amount,
                'wv'=>$wv,
                'type' => 'original',
                'remarks' => $remarks,
                'request_part' => $request_part,
            );

            $exist = ['parts' => true];
            // Create a loop and check what kind of work order inside the JO
            
            if(isset($exist['parts'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "PARTS.pdf"
                );
            }

        }

    }


    public function duplicateExport2PDF($dataID){
        $job_order_data = JobOrder::with('clientProfile.contacts', 'clientProfile.forCSA', 'getContact', 'getJobOrderTransaction')->where('id',$dataID)->whereIn('status', [1,2,3,4,9])->whereIn('payment_status_id', [12, 13])->first();
        $latestID = JobOrder::where('status',9)->where('payment_status_id', 12)->count();
        $related_work_order = WorkOrder::with('getERScope','getScopeDescription', 'getDiscount', 'getGeneralProcedure', 'getJobType')->where('jo_no_id',$job_order_data->id)->whereIn('status', [5,6,9])->get()->groupBy('getJobType.abbriv_code');
        $business_info = Branch::where('id', 1)->first();
        $remarks = TransactionSummary::with('getRemarks')->where('transaction_type_id', ServiceInvoice::SERVICE_INVOICE)->where('jo_no', $dataID)->first();
        
        // Get the parts
        // $request_part = RequestPart::with('getRequestTool.requestToolsData.getStockManagment')->where('jo_no_id', $dataID)->first();
        $request_part = RequestTool::with('requestToolsData.getStockManagment')
        ->where('jo_no_id', $dataID)
        ->where('status_id', 2)
        ->get();

        $overall_part_total = 0;
        if(!empty($request_part)){
            // foreach ($request_part->getRequestTool->requestToolsData as $value){
            //     $overall_part_total += $value->qty * $value->selling_price;
            // }
            foreach ($request_part as $request) {
                foreach ($request->requestToolsData as $tools) {
                    $overall_part_total += $tools->qty * $tools->selling_price;
                }
            }
        }

        // if(count($related_work_order) < 1){
        //     $related_work_order = WorkOrder::with('getERScope','getScopeDescription', 'getDiscount', 'getGeneralProcedure')->where('jo_no_id',$job_order_data->id)->where('status', null)->get();
        // }

        if (count($related_work_order) > 0) {

            $total_amount = 0;
            foreach ($related_work_order as $datas) {
                foreach ($datas as $data) {
                    if($data->status != 3){
                        if($data->max_discount == 0){
                            $data->max_discount == 1;
                            $output = 0;
                        }else{
                            // $output = (($data->price + $data->amount_increase) * $data->qty) / $data->max_discount;
                            $output=(($data->price+$data->amount_increase) * $data->qty)*($data->max_discount/100);
                        }
    
                        $total = (($data->price+$data->amount_increase) * $data->qty) - $output;
                        $total_amount += $total;
                    }
                }
            }

            if(!empty($request_part)){
                $total_amount += $overall_part_total;
            }

            if($this->checkAbleToPrint()){
                // Update the printed_original
                JobOrder::where('id', $dataID)->update([
                    'printed_duplicate' => 1
                ]);
            }
    
            $wv = str_pad($latestID, 5, '0', STR_PAD_LEFT);
    
            $records = array(
                'data'=> $job_order_data,
                'related_work_order'=>$related_work_order,
                'total_amount'=>$total_amount,
                'wv'=>$wv,
                'type' => 'duplicate',
                'remarks' => $remarks,
                'request_part' => $request_part,
            );
            
            $exist = [];
            foreach ($related_work_order as $key => $values) {
                foreach ($values as $value) {
                    if($value->mf_work_group_id && $value->mf_work_sub_type_id){
                        $exist['mf'] = true;
                    }elseif($value->er_work_group_id && $value->scopes_id){
                        $exist['er'] = true;
                    }elseif($value->calib_work_group_id && $value->calib_work_sub_type_id){
                        $exist['calib'] = true;
                    }
                }
            }
            
            if(isset($exist['mf']) && isset($exist['er']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&ER&CALIB.pdf"
                );
            }else if(isset($exist['mf']) && isset($exist['er'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&ER.pdf"
                );
            }else if(isset($exist['mf']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&CALIB.pdf"
                );
            }else if(isset($exist['er']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "ER&CALIB.pdf"
                );
            }else if(isset($exist['mf'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF.pdf"
                );
            } else if(isset($exist['er'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "ER.pdf"
                );
            } else if(isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info' => $business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "CALIB.pdf"
                );
            }
        }elseif (count($related_work_order) == 0 && $overall_part_total > 0){
            $total_amount = 0;

            if(!empty($request_part)){
                $total_amount += $overall_part_total;
            }

            if($this->checkAbleToPrint()){
                // Update the printed_original
                JobOrder::where('id', $dataID)->update([
                    'printed_duplicate' => 1
                ]);
            }

            $wv = $wv = str_pad($latestID, 5, '0', STR_PAD_LEFT);

            $records = array(
                'data'=> $job_order_data,
                'related_work_order'=>$related_work_order,
                'total_amount'=>$total_amount,
                'wv'=>$wv,
                'type' => 'duplicate',
                'remarks' => $remarks,
                'request_part' => $request_part,
            );

            $exist = ['parts' => true];
            // Create a loop and check what kind of work order inside the JO
            
            if(isset($exist['parts'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "PARTS.pdf"
                );
            }

        }

    }

    public function triplicateExport2PDF($dataID){
        $job_order_data = JobOrder::with('clientProfile.contacts', 'clientProfile.forCSA', 'getContact', 'getJobOrderTransaction')->where('id',$dataID)->whereIn('status', [1,2,3,4,9])->whereIn('payment_status_id', [12,13])->first();
        $latestID = JobOrder::where('status',9)->where('payment_status_id', 12)->count();
        $related_work_order = WorkOrder::with('getERScope','getScopeDescription', 'getDiscount', 'getGeneralProcedure', 'getJobType')->where('jo_no_id',$job_order_data->id)->whereIn('status', [5,6,9])->get()->groupBy('getJobType.abbriv_code');
        $cancelled_work_order = WorkOrder::with('getJobOrder.getContact', 'getCancelReason', 'getUserCancel', 'getERScope')->where('jo_no_id',$job_order_data->id)->where('status', 3)->get();
        $business_info = Branch::where('id', 1)->first();
        $remarks = TransactionSummary::with('getRemarks')->where('transaction_type_id', ServiceInvoice::SERVICE_INVOICE)->where('jo_no', $dataID)->first();
        
        // Get the parts
        // $request_part = RequestPart::with('getRequestTool.requestToolsData.getStockManagment')->where('jo_no_id', $dataID)->first();
        $request_part = RequestTool::with('requestToolsData.getStockManagment')
        ->where('jo_no_id', $dataID)
        ->where('status_id', 2)
        ->get();

        $overall_part_total = 0;
        if(!empty($request_part)){
            // foreach ($request_part->getRequestTool->requestToolsData as $value){
            //     $overall_part_total += $value->qty * $value->selling_price;
            // }
            foreach ($request_part as $request) {
                foreach ($request->requestToolsData as $tools) {
                    $overall_part_total += $tools->qty * $tools->selling_price;
                }
            }
        }

        // if(count($related_work_order) < 1){
        //     $related_work_order = WorkOrder::with('getERScope','getScopeDescription', 'getDiscount', 'getGeneralProcedure')->where('jo_no_id',$job_order_data->id)->where('status', null)->get();
        // }

        // Get the JOCN number
        $jocn_no = TransactionSummary::where('jo_no', $job_order_data->id)->whereIn('transaction_status_id', [2, 3])->whereIn('status_id', [3, 12, 13])->first();
        if (count($related_work_order) > 0) {

            $total_amount = 0;
            foreach ($related_work_order as $datas) {
                foreach ($datas as $data) {
                    if($data->status != 3){
                        if($data->max_discount == 0){
                            $data->max_discount == 1;
                            $output = 0;
                        }else{
                            // $output = (($data->price + $data->amount_increase) * $data->qty) / $data->max_discount;
                            $output=(($data->price+$data->amount_increase) * $data->qty)*($data->max_discount/100);
                        }
    
                        $total = (($data->price+$data->amount_increase) * $data->qty) - $output;
                        $total_amount += $total;
                    }
                }
            }

            if(!empty($request_part)){
                $total_amount += $overall_part_total;
            }

            if($this->checkAbleToPrint()){
                // Update the printed_original
                JobOrder::where('id', $dataID)->update([
                    'printed_triplicate' => 1
                ]);
            }

            $wv = $jocn_no->wv_invoice_no;

            $records = array(
                'data'=> $job_order_data,
                'related_work_order'=>$related_work_order,
                'total_amount'=>$total_amount,
                'wv'=>$wv,
                'type' => 'triplicate',
                'cancelled_work_order' => $cancelled_work_order,
                'remarks' => $remarks,
                'request_part' => $request_part,
            );

            $exist = [];
            foreach ($related_work_order as $key => $values) {
                foreach ($values as $value) {
                    if($value->mf_work_group_id && $value->mf_work_sub_type_id){
                        $exist['mf'] = true;
                    }elseif($value->er_work_group_id && $value->scopes_id){
                        $exist['er'] = true;
                    }elseif($value->calib_work_group_id && $value->calib_work_sub_type_id){
                        $exist['calib'] = true;
                    }
                }
            }
            // Create a loop and check what kind of work order inside the JO
            // dd($exist);
            // dd(isset($exist['mf']) && isset($exist['er']) && isset($exist['calib']));
            if(isset($exist['mf']) && isset($exist['er']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&ER&CALIB.pdf"
                );
            }else if(isset($exist['mf']) && isset($exist['er'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&ER.pdf"
                );
            }else if(isset($exist['mf']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&CALIB.pdf"
                );
            }else if(isset($exist['er']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "ER&CALIB.pdf"
                );
            }else if(isset($exist['mf'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF.pdf"
                );
            } else if(isset($exist['er'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "ER.pdf"
                );
            } else if(isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "CALIB.pdf"
                );
            }
        }elseif (count($related_work_order) == 0 && $overall_part_total > 0){
            $total_amount = 0;

            if(!empty($request_part)){
                $total_amount += $overall_part_total;
            }

            if($this->checkAbleToPrint()){
                // Update the printed_original
                JobOrder::where('id', $dataID)->update([
                    'printed_triplicate' => 1
                ]);
            }

            $wv = $jocn_no->wv_invoice_no;

            $records = array(
                'data'=> $job_order_data,
                'related_work_order'=>$related_work_order,
                'total_amount'=>$total_amount,
                'wv'=>$wv,
                'type' => 'triplicate',
                'cancelled_work_order' => $cancelled_work_order,
                'remarks' => $remarks,
                'request_part' => $request_part,
            );

            $exist = ['parts' => true];
            // Create a loop and check what kind of work order inside the JO
            
            if(isset($exist['parts'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "PARTS.pdf"
                );
            }

        }elseif (count($cancelled_work_order) > 0){
            $total_amount = 0;

            if($this->checkAbleToPrint()){
                // Update the printed_original
                JobOrder::where('id', $dataID)->update([
                    'printed_triplicate' => 1
                ]);
            }

            $wv = $jocn_no->wv_invoice_no ?? '';

            $records = array(
                'data'=> $job_order_data,
                'related_work_order'=>$related_work_order,
                'total_amount'=>$total_amount,
                'wv'=>$wv,
                'type' => 'triplicate',
                'cancelled_work_order' => $cancelled_work_order,
            );

            $exist = [];
            foreach ($cancelled_work_order as $key => $value) {
                if($value->mf_work_group_id && $value->mf_work_sub_type_id){
                    $exist['mf'] = true;
                }elseif($value->er_work_group_id && $value->scopes_id){
                    $exist['er'] = true;
                }elseif($value->calib_work_group_id && $value->calib_work_sub_type_id){
                    $exist['calib'] = true;
                }
            }
            
            if(isset($exist['mf']) && isset($exist['er']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&ER&CALIB.pdf"
                );
            }else if(isset($exist['mf']) && isset($exist['er'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&ER.pdf"
                );
            }else if(isset($exist['mf']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF&CALIB.pdf"
                );
            }else if(isset($exist['er']) && isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "ER&CALIB.pdf"
                );
            }else if(isset($exist['mf'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "MF.pdf"
                );
            } else if(isset($exist['er'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "ER.pdf"
                );
            } else if(isset($exist['calib'])){
                $pdfContent = PDF::loadView('livewire.j-o-m-s.sales-invoice-print', ['records'=>$records, 'business_info'=>$business_info])->output();
                redirect()->to('/job-order-receipts');
                return response()->streamDownload(
                fn () => print($pdfContent),
                "CALIB.pdf"
                );
            }
        }

    }

    public function render()
    {
        return view('livewire.j-o-m-s.job-order-original-report-table', [
            
            'job_orders_original' => TransactionSummary::where('wv_invoice_no', 'LIKE', '%WV%')
                        ->with('jobOrder.clientProfile', 'jobOrder.getStatus')
                        ->whereIn('transaction_status_id', [2, 3])
                        ->whereIn('status_id', [3, 12, 13])
                        ->whereHas('jobOrder', function($query) {
                            return $query->where('overall_total', '!=' , null)->whereIn('payment_status_id', [12, 13]);
                        })
                        ->get(),
        ]);
    }
}
