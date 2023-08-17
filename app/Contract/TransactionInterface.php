<?php

namespace App\Contract;

interface TransactionInterface{

    // Create | Update
    public function transactionSummary($data, $transactionId);
    // Create | Update
    public function transactionData($transactionId, $listItems, $oldItems, $data, $createTransactionId);

    public function transactionParticulars($id);

}