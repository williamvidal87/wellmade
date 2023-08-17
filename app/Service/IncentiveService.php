<?php

namespace App\Service;

use App\Contract\IncentiveInterface;
use App\Models\TransactionSummary;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\Log;

class IncentiveService implements IncentiveInterface{

    public function calculateIncentive($id)
    {
        $work_order = WorkOrder::with('getIncentiveType')
        ->where('jo_no_id', $id)
        ->whereNull('cancel_reason_id')
        ->whereHas('getJobOrder', function ($query) {
            $query->whereNotNUll('contact_person');
        })
        ->get();
        $transaction_info = TransactionSummary::with('jobOrder', 'jobOrder.WorkOrders')->where('jo_no',$id)->where('transaction_status_id', 2)->whereIn('status_id', [12,13])->first();
        
        $total_amount_er = 0;
        $er_vat = 0;
        $er_disc = 0;
        $total_amount_mf = 0;
        $mf_vat = 0;
        $mf_disc = 0;
        $total_amount_calib = 0;
        $calib_vat = 0;
        $calib_disc = 0;
        $count_er = 0;
        $count_mf = 0;
        $count_calib = 0;
        $max_discount_er = 0;
        $max_discount_mf = 0;
        $max_discount_calib = 0;

        foreach ($work_order as $key => $value) {
            if($value->er_work_group_id){
                $total_amount_er += (($value->price+$value->amount_increase) * $value->qty);
                if($value->max_discount > 0){
                    $max_discount_er = $value->max_discount;
                }
            }elseif ($value->mf_work_group_id){
                $total_amount_mf += (($value->price+$value->amount_increase) * $value->qty);
                if($value->max_discount > 0){
                    $max_discount_mf = $value->max_discount;
                }
            }elseif ($value->calib_work_group_id){
                $total_amount_calib += (($value->price+$value->amount_increase) * $value->qty);
                if($value->max_discount > 0){
                    $max_discount_calib = $value->max_discount;
                }
            }
        }

        foreach ($work_order as $key => $value) {
            // ER CALCULATION
            if($value->er_work_group_id && $count_er == 0){
                $count_er++;
                if($transaction_info->sb_invoice_no != null){
                    $vat = 12;
                    $deduct = 0;
                    $er_vat = $total_amount_er * ($vat/100);
                    // $total_amount_er = $total_amount_er - $deduct;
                    // check if has discount
                    if($max_discount_er > 0){
                        $er_disc = ($total_amount_er * ($max_discount_er/100));
                        $total_amount_er = ($total_amount_er - ($er_vat + $er_disc)) * (($value->getIncentiveType->incentive_type - $max_discount_er)/100);
                    }else{
                        $total_amount_er = ($total_amount_er - ($er_vat + $er_disc)) * (20/100);
                    }


                }else{
                    $vat = 0;
                    if($max_discount_er > 0){
                        $total_amount_er = ($total_amount_er - ($total_amount_er * ($max_discount_er/100))) * (($value->getIncentiveType->incentive_type - $max_discount_er)/100);
                    }else{
                        $total_amount_er = $total_amount_er * (20/100);
                    }

                }
            }

            // MF CALCULATION
            if($value->mf_work_group_id && $count_mf == 0){
                $count_mf++;
                if($transaction_info->sb_invoice_no != null){
                    $vat = 12;
                    $deduct = 0;
                    $mf_vat = $total_amount_mf * ($vat/100);
                    // $total_amount_mf = $total_amount_mf - $deduct;
                    // check if has discount
                    if($max_discount_mf > 0){
                        $mf_disc = ($total_amount_mf * ($max_discount_mf/100));
                        $total_amount_mf = ($total_amount_mf - ($mf_vat + $mf_disc)) * (($value->getIncentiveType->incentive_type - $max_discount_mf)/100);
                    }else{
                        $total_amount_mf = ($total_amount_mf - ($mf_vat + $mf_disc)) * (10/100);
                    }

                }else{
                    $vat = 0;
                    if($max_discount_mf > 0){
                        $total_amount_mf = ($total_amount_mf - ($total_amount_mf * ($max_discount_mf/100))) * (($value->getIncentiveType->incentive_type - $max_discount_mf)/100);
                    }else{
                        $total_amount_mf = $total_amount_mf * (10/100);
                    }

                }
            }

            // CALIB CALCULATION
            if($value->calib_work_group_id && $count_calib == 0){
                $count_calib++;
                if($transaction_info->sb_invoice_no != null){
                    $vat = 12;
                    $deduct = 0;
                    $calib_vat = $total_amount_calib * ($vat/100);
                    // check if has discount
                    if($max_discount_calib > 0){
                        $calib_disc = ($total_amount_calib * ($max_discount_calib/100));
                        $total_amount_calib = ($total_amount_calib - ($calib_vat + $calib_disc)) * (($value->getIncentiveType->incentive_type - $max_discount_calib)/100);
                    }else{
                        $total_amount_calib = ($total_amount_calib - ($calib_vat + $calib_disc)) * (10/100);
                    }


                }else{
                    $vat = 0;
                    if($max_discount_calib > 0){
                        $total_amount_calib = ($total_amount_calib - ($total_amount_calib * ($max_discount_calib/100))) * (($value->getIncentiveType->incentive_type - $max_discount_calib)/100);
                    }else{
                        $total_amount_calib = $total_amount_calib * (10/100);
                    }

                }
            }

        }

        return ($total_amount_mf + $total_amount_er + $total_amount_calib);
    }

}