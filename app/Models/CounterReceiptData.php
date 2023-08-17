<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterReceiptData extends Model
{
    use HasFactory;

    protected $fillable = [
        'cr_id',
        'transaction_summary_cr_id',
        'transaction_payment_cr_id',
        'update_counter_receipt',
        'counter_receipt_arrangement',
        'status_id',
    ];
    
    public function getTransactionSummary()
    {
        return $this->belongsTo(TransactionSummary::class, 'transaction_summary_cr_id');
    }

    public function getTransactionPayment()
    {
        return $this->belongsTo(TransactionSummary::class, 'transaction_payment_cr_id');
    }

    public function getCounterReceipt()
    {
        return $this->belongsTo(CounterReceipt::class, 'cr_id');
    }

    public function getStatus()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
