<?php

namespace App\Http\Livewire\Billing;

use App\Models\JoAcknowledgementReceipt;
use App\Models\JobOrder;
use App\Models\RequestPart;
use App\Models\RequestTool;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class JoAcknowledgementReceiptForm extends Component
{

    public $date, $customer, $csa, $model, $engine_make, $serial_no, $remarks, $joAcknowledgementReceiptId;
    public $er_total, $mf_total, $calib_total, $sub_total, $overall_total, $part_total;
    public $term = 0;
    public $discount = 0;
    public $er_disp = 0;
    public $mf_disp = 0;
    public $calib_disp = 0;
    public $overall_disp = 0;
    protected $listeners = [
        'joAcknowledgementReceiptId',
        'editjoAcknowledgementReceiptId',
        'resetInputFields',
    ];

    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function editjoAcknowledgementReceiptId($joAcknowledgementReceiptId)
    {
        $this->resetInputFields();
        $this->joAcknowledgementReceiptId = $joAcknowledgementReceiptId;
        $jo_acknowledgement_receipt = JobOrder::with('clientProfile', 'getCSA', 'engineModel', 'getMakeList')->where('id', $joAcknowledgementReceiptId)->first();
        $this->date =  date('Y-m-d', strtotime($jo_acknowledgement_receipt->date));
        $this->customer =  $jo_acknowledgement_receipt->clientProfile->name ?? '';
        $this->term =  $jo_acknowledgement_receipt->term ?? '';
        $this->csa =  $jo_acknowledgement_receipt->getCSA->csa_type ?? '';
        $this->model =  $jo_acknowledgement_receipt->engineModel->model ?? '';
        $this->engine_make =  $jo_acknowledgement_receipt->getMakeList->make_name ?? '';
        $this->serial_no =  $jo_acknowledgement_receipt->serial_no ?? '';
        $this->remarks =  $jo_acknowledgement_receipt->remarks ?? '';

        $this->er_total = $jo_acknowledgement_receipt->er_total ?? '';
        $this->mf_total = $jo_acknowledgement_receipt->mf_total ?? '';
        $this->calib_total = $jo_acknowledgement_receipt->calib_total ?? '';
        $this->part_total = $jo_acknowledgement_receipt->part_total ?? '';
        $this->discount = number_format($jo_acknowledgement_receipt->discount ?? 0, 2);
        $this->updated();
    }

    public function joAcknowledgementReceiptId($joAcknowledgementReceiptId)
    {
        $overall_part_total = 0;
        $this->resetInputFields();
        $this->joAcknowledgementReceiptId = $joAcknowledgementReceiptId;
        $jo_acknowledgement_receipt = JobOrder::with('clientProfile', 'getCSA', 'engineModel', 'getMakeList')->where('id', $joAcknowledgementReceiptId)->first();
        $this->date =  date('Y-m-d', strtotime($jo_acknowledgement_receipt->date));
        $this->customer =  $jo_acknowledgement_receipt->clientProfile->name ?? '';
        // $this->term =  $jo_acknowledgement_receipt->term;
        $this->csa =  $jo_acknowledgement_receipt->getCSA->csa_type ?? '';
        $this->model =  $jo_acknowledgement_receipt->engineModel->model ?? '';
        $this->engine_make =  $jo_acknowledgement_receipt->getMakeList->make_name ?? '';
        $this->serial_no =  $jo_acknowledgement_receipt->serial_no ?? '';
        $this->remarks =  $jo_acknowledgement_receipt->remarks ?? '';

        // Get the parts
        // $request_part = RequestPart::with('getRequestTool.requestToolsData.getStockManagment')->where('jo_no_id', $jo_acknowledgement_receipt->id)->first();
        $request_part = RequestTool::with('requestToolsData.getStockManagment')
            ->where('jo_no_id', $jo_acknowledgement_receipt->id)
            ->where('status_id', 2)
            ->get();

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

        $work_orders = WorkOrder::where('jo_no_id', $joAcknowledgementReceiptId)->whereNull('cancel_reason_id')->get();

        // if(count($work_orders) > 0) {
            $overall_er_total = 0;
            $overall_mf_total = 0;
            $overall_calib_total = 0;
    
            $total_discount = 0;
            foreach ($work_orders as $data) {
                    if($data->mf_work_group_id != null){

                        if($data->max_discount == 0){
                            $data->max_discount == 1;
                            $output = 0;
                        }else{
                            $output=(($data->price+$data->amount_increase) * $data->qty)*($data->max_discount/100);
                            // $output = (($data->price + $data->amount_increase) * $data->qty) / $data->max_discount;
                        }

                        $this->mf_disp += (($data->price+$data->amount_increase) * $data->qty);
                        $overall_mf_total += (($data->price+$data->amount_increase) * $data->qty) - $output;
                        $total_discount += $output;
                    }
                    
                    if($data->er_work_group_id != null){
                        if($data->max_discount == 0){
                            $data->max_discount == 1;
                            $output = 0;
                        }else{
                            $output=(($data->price+$data->amount_increase) * $data->qty)*($data->max_discount/100);
                            // $output = (($data->price + $data->amount_increase) * $data->qty) / $data->max_discount;
                        }

                        $this->er_disp += (($data->price+$data->amount_increase) * $data->qty);
                        $overall_er_total += (($data->price+$data->amount_increase) * $data->qty) - $output;
                        $total_discount += $output;                   
                    }
                    
                    if($data->calib_work_group_id != null){
                        if($data->max_discount == 0){
                            $data->max_discount == 1;
                            $output = 0;
                        }else{
                            $output=(($data->price+$data->amount_increase) * $data->qty)*($data->max_discount/100);
                            // $output = (($data->price + $data->amount_increase) * $data->qty) / $data->max_discount;
                        }

                        $this->calib_disp += (($data->price+$data->amount_increase) * $data->qty);
                        $overall_calib_total += (($data->price+$data->amount_increase) * $data->qty) - $output;
                        $total_discount += $output;
                    }

            }
            $this->overall_disp = number_format($this->er_disp + $this->mf_disp + $this->calib_disp + $overall_part_total , 2);
            $this->er_disp = number_format($this->er_disp, 2); 
            $this->mf_disp = number_format($this->mf_disp, 2);
            $this->calib_disp = number_format($this->calib_disp, 2);
            $this->discount = number_format($total_discount, 2);
            $this->mf_total = $overall_mf_total;
            $this->er_total = $overall_er_total;
            $this->calib_total = $overall_calib_total; 
            $this->part_total = $overall_part_total; 
            $this->updated();

        // }
    }

    public function updatedJoNo($id)
    {
        $jo = JobOrder::with('clientProfile', 'getCSA', 'engineModel', 'getMakeList')->where('id', $id)->first();
        $this->date = date('Y-m-d', strtotime($jo->date));
        $this->customer = $jo->clientProfile->name;
        $this->csa = $jo->getCSA->csa_type;
        $this->model = $jo->engineModel->model ?? '';
        $this->engine_make = $jo->getMakeList->make_name;
        $this->serial_no = $jo->serial_no;
        $this->remarks = $jo->remarks;
    }

    public function updated()
    {
        // Convert the totals to float
        $types = ['er_total', 'mf_total', 'calib_total', 'part_total'];

        for ($i = 0; $i < sizeof($types); $i++) {
            $this->{$types[$i]} = floatval(preg_replace('/[^\d.]/', '', $this->{$types[$i]}));
        }

        $subtotal = 0;

        for ($i=0; $i < sizeof($types); $i++) { 
            $this->{$types[$i]} = empty($this->{$types[$i]}) ? 0.00 : (is_numeric($this->{$types[$i]}) ? $this->{$types[$i]} : 0.00);

            $subtotal += round($this->{$types[$i]}, 2);
        }

        $this->sub_total = $subtotal;
        $this->sub_total = number_format($this->sub_total, 2);

        // // Compute for discount
        // if($this->discount > 0){
        //     $this->discount = floatval(preg_replace('/[^\d.]/', '', $this->discount));
        //     $percentage = $this->discount / 100;
        //     $deduct = round($subtotal * $percentage, 2);
        //     $overall_deduct = $subtotal - $deduct;
        //     $this->overall_total = number_format($overall_deduct, 2);
        // }else{
        //     // Display total
        //     $this->overall_total = $this->sub_total;
        // }
        $this->overall_total = $this->sub_total;

        for ($i = 0; $i < sizeof($types); $i++) {
            if ($this->{$types[$i]} == 0.00) {
                $this->{$types[$i]} = "0.00";
            } else {
                $this->{$types[$i]} = number_format((float) $this->{$types[$i]}, 2);
            }
        }

    }

    public function store()
    {

        $data = $this->validate([
            'term' => 'required',
        ]);

        $data['discount'] = $this->discount;
        $data['er_total'] = $this->er_total;
        $data['mf_total'] = $this->mf_total;
        $data['calib_total'] = $this->calib_total;
        $data['part_total'] = $this->part_total;
        $data['overall_total'] = $this->overall_total;

        try {
            if ($this->joAcknowledgementReceiptId) {
                // Convert the string all total debits & all total credits into float bfore to save
                $data['er_total'] = floatval(preg_replace('/[^\d.]/', '', $data['er_total']));
                $data['mf_total'] = floatval(preg_replace('/[^\d.]/', '', $data['mf_total']));
                $data['calib_total'] = floatval(preg_replace('/[^\d.]/', '', $data['calib_total']));
                $data['part_total'] = floatval(preg_replace('/[^\d.]/', '', $data['part_total']));
                $data['overall_total'] = floatval(preg_replace('/[^\d.]/', '', $data['overall_total']));
                $data['discount'] = floatval(preg_replace('/[^\d.]/', '', $data['discount']));

                JobOrder::find($this->joAcknowledgementReceiptId)->update($data);
            } else {

            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->joAcknowledgementReceiptId) {
            $action = 'edit';
            $message = 'JO Acknowledgement Receipt Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'JO Acknowledgement Receipt Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeJoAcknowledgementReceiptModal');
        return redirect()->to('/jo-acknowledgement-receipt');
    }

    public function render()
    {
        return view('livewire.billing.jo-acknowledgement-receipt-form', [
            'job_orders' => JobOrder::whereIn('status', [1, 9])->whereIn('payment_status_id', [12, 13])->get(),
        ]);
    }
}
