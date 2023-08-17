<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'receipt_type_id',
        'transaction_type_id',
        'receipt_no',
        'receipt_for',
        'jo_no',
        'client_id',
        'customer_name',
        'bank',
        'gl_account_bank',
        'check_no',
        'sb_date',
        'transaction_status_id',
        'status_id',
        'all_total_debits',
        'all_total_credits',
        'for',
        'collected_by_id',
        'payment_type_id',
        'customer_bank_id',
        'dated',
        'cheque_no',
        'receipt',
        'remark_id',
        'invoice_type_id',
        'wv_invoice_no',
        'wv_date',
        'sb_invoice_no',
        'ar_transaction',
        'or_transaction',
        'time',
    ];

    public function getInvoiceType()
    {
        return $this->hasOne(InvoiceTypes::class, 'id', 'invoice_type_id');
    }

    public function getRemarks()
    {
        return $this->hasOne(Remark::class, 'id', 'remark_id');
    }

    public function getCollect()
    {
        return $this->belongsTo(Collect::class, 'collected_by_id');
    }

    public function getPaymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function getCustomerBank()
    {
        return $this->belongsTo(Bank::class, 'customer_bank_id');
    }

    public function clientProfile()
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    public function paymentStatus()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function transactionStatus()
    {
        return $this->belongsTo(TransactionStatus::class, 'transaction_status_id');
    }

    public function receiptType()
    {
        return $this->belongsTo(ReceiptTypes::class, 'receipt_type_id');
    }

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class, 'jo_no');
    }

    public function receiptFor()
    {
        return $this->belongsTo(ReceiptFor::class, 'receipt_for');
    }

    public function fors()
    {
        return $this->belongsTo(TransactionFor::class, 'for');
    }

    public function bankType()
    {
        return $this->belongsTo(Bank::class, 'bank');
    }

    //for daily reconciliation
    public function getClient()
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

}
