<?php

namespace App\Service;

use App\Contract\TransactionInterface;
use App\Enums\Status;
use App\Enums\TransactionStatus;
use App\Models\TransactionData;
use App\Models\TransactionParticular;
use App\Models\TransactionSummary;

class TransactionService implements TransactionInterface{

    public function transactionSummary($data, $transactionId)
    {

        if ($transactionId) {
            
            // Convert the string all total debits & all total credits into float bfore to save
            for ($i=0; $i < sizeof($data); $i++) {
                $data['all_total_debits'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_debits']));
                $data['all_total_credits'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_credits']));
            }

            // Update the purchase order to the latest data
            // TransactionSummary::where('id', $transactionId)->update($data);
            $transaction = TransactionSummary::find($transactionId);
            $transaction->update($data);

        } else {
            // dd("Create Transaction Summary");
            // Convert the string all total debits & all total credits into float bfore to save
            for ($i=0; $i < sizeof($data); $i++) {
                $data['all_total_debits'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_debits']));
                $data['all_total_credits'] = floatval(preg_replace('/[^\d.]/', '', $data['all_total_credits']));
            }
            
            $data = TransactionSummary::create($data);

            return $data->id;
        }

    }

    public function transactionData($transactionId, $listItems, $oldItems, $data, $createTransactionId)
    {
        if ($transactionId) {

            // Convert the string debits and credits into float bfore to save
            foreach ($listItems as $key => $value) {
                if(!empty($listItems[$key]['debits'])){
                    $listItems[$key]['debits'] = floatval(preg_replace('/[^\d.]/', '', $listItems[$key]['debits']));
                }else{
                    $listItems[$key]['debits'] = 0.00;
                }
                if(!empty($listItems[$key]['credits'])){
                    $listItems[$key]['credits'] = floatval(preg_replace('/[^\d.]/', '', $listItems[$key]['credits']));
                }else{
                    $listItems[$key]['credits'] = 0.00;
                }
            }

            // Update product to true in update product column
            foreach ($listItems as $key => $value) {
                TransactionData::updateOrCreate([
                'transaction_summary_id' => $transactionId,
                'account_number' => (int) $listItems[$key]['accnt_no']
                ], [
                    'transaction_summary_id' => $transactionId,
                    'account_number' => (int) $listItems[$key]['accnt_no'],
                    'account_title' => $listItems[$key]['account_title'],
                    'update_transaction' => 1,
                    'transaction_arrangement' => $key,
                    'debits' => $listItems[$key]['debits'],
                    'credits' => $listItems[$key]['credits'],
                ]);
            }

            // Delete product that is false
            foreach ($listItems as $key => $value) {
                TransactionData::where('transaction_summary_id', '=', $transactionId)
                ->where('update_transaction', '=', 0)
                ->delete();
            }

            // Return back all transaction back to false
            foreach ($listItems as $key => $value) {
                TransactionData::where('transaction_summary_id', '=', $transactionId)
                ->where('account_number', '=', (int) $listItems[$key]['accnt_no'])
                ->update([
                    'update_transaction' => 0,
                ]);
            }


        } else {
            // Convert the string debits and credits into float bfore to save
            foreach ($listItems as $key => $value) {
                if(!empty($listItems[$key]['debits'])){
                    $listItems[$key]['debits'] = floatval(preg_replace('/[^\d.]/', '', $listItems[$key]['debits']));
                }else{
                    $listItems[$key]['debits'] = 0.00;
                }
                if(!empty($listItems[$key]['credits'])){
                    $listItems[$key]['credits'] = floatval(preg_replace('/[^\d.]/', '', $listItems[$key]['credits']));
                }else{
                    $listItems[$key]['credits'] = 0.00;
                }
            }
            
            foreach ($listItems as $key => $value) {
                TransactionData::insert([
                    'transaction_summary_id' => $createTransactionId,
                    'account_number' => (int) $value['accnt_no'],
                    'account_title' => $value['account_title'],
                    'transaction_arrangement' => $key,
                    'debits' => $value['debits'],
                    'credits' => $value['credits'],
                ]);

            }

        }
        

    }

    public function transactionParticulars($id)
    {
        // Delete in the particulars table if entry exists
        $getReceiptPaymentId = TransactionParticular::where('transaction_summary_invoice_id', $id)->first();

        if($getReceiptPaymentId != null){

            $getReceiptPaymentId = $getReceiptPaymentId->transaction_summary_receipt_id;

            TransactionParticular::where('transaction_summary_invoice_id', $id)->delete();

            // Check if there are another invoice inside the particulars that are related
            $allTransac = TransactionParticular::where('transaction_summary_receipt_id', $getReceiptPaymentId)->get();

            if(count($allTransac) > 0){
                // Total the remaining debits and credits
                $totalDebits = 0;
                $totalCredits = 0;

                // dd($allTransac);
                foreach ($allTransac as $key => $value) {
                    $transac = TransactionSummary::where('id', $value->transaction_summary_invoice_id)->where('status_id', 12)->first();
                    if($transac != null){
                        $totalDebits += $transac->all_total_debits;
                        $totalCredits += $transac->all_total_credits;

                        // TransactionSummary::where('id', $value->transaction_summary_invoice_id)->update([
                        //     'status_id' => 13,
                        // ]);
                        $transac->update([
                            'status_id' => 13,
                        ]);
                    }
                }

                // Return the receipt payments back to setup
                $transaction = TransactionSummary::find($getReceiptPaymentId);
                $transaction->update([
                    'status_id' => Status::UNPAID, // 3 => Cancelled status
                    'transaction_status_id' => TransactionStatus::SETUP,
                    'all_total_debits' => $totalDebits,
                    'all_total_credits' => $totalCredits,
                ]);

                // Update the journalization in db
                // $getId =TransactionSummary::where('id',$getReceiptPaymentId)->first();

                TransactionData::where('transaction_summary_id', $transaction->id)->where('account_number', 3)->update([
                    'debits' => $totalDebits,
                    'credits' => (double) 0.00,
                ]);

                TransactionData::where('transaction_summary_id', $transaction->id)->where('account_number', 6)->update([
                    'debits' => (double) 0.00,
                    'credits' => $totalCredits,
                ]);

            }else{
                // Return the receipt payments back to setup
                $transaction = TransactionSummary::find($getReceiptPaymentId);
                $transaction->update([
                    'status_id' => Status::UNPAID, // 3 => Cancelled status
                    'transaction_status_id' => TransactionStatus::SETUP,
                    'all_total_debits' => (double) 0.00,
                    'all_total_credits' => (double) 0.00,
                ]);

                // Update the journalization in db
                // $getId =TransactionSummary::where('id',$getReceiptPaymentId)->first();

                TransactionData::where('transaction_summary_id', $transaction->id)->where('account_number', 3)->update([
                    'debits' => (double) 0.00,
                    'credits' => (double) 0.00,
                ]);

                TransactionData::where('transaction_summary_id', $transaction->id)->where('account_number', 6)->update([
                    'debits' => (double) 0.00,
                    'credits' => (double) 0.00,
                ]);
            }
        
        }
    }


}