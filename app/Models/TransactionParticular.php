<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionParticular extends Model
{
    use HasFactory;

    public $fillable = [
        'transaction_summary_invoice_id',
        'transaction_summary_receipt_id',
        'total_paid',
        'this_payment',
    ];

    public function transactionSummaryReceipt()
    {
        return $this->belongsTo(TransactionSummary::class, 'transaction_summary_receipt_id');
    }

    public function transactionSummaryInvoice()
    {
        return $this->belongsTo(TransactionSummary::class, 'transaction_summary_invoice_id');
    }

}
