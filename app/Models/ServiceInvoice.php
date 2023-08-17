<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'receipt_type_id',
        'receipt_no',
        'receipt_for',
        'document_type',
        'jo_no',
        'customer_name',
        'bank',
        'gl_account_bank',
        'check_no',
        'sb_date',
        'all_total_debits',
        'all_total_credits',
    ];

    public function receiptType()
    {
        return $this->belongsTo(ReceiptTypes::class, 'receipt_type_id');
    }

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class, 'jo_no');
    }

}
