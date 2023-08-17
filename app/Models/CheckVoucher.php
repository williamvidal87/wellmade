<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'voucher_type_id',
        'for_id',
        'bank_id',
        'supplier_id',
        'amount',
        'check_no',
        'check_date',
        'summary_explanation',
        'particulars',
        'transaction_status_id',
    ];

    public function getSupplierId()
    {
        return $this->hasOne(BillingSupplier::class, 'id', 'supplier_id');
    }

    public function getTransactionStatus()
    {
        return $this->hasOne(TransactionStatus::class , 'id', 'transaction_status_id');
    }

    public function getCheckVoucherData()
    {
        return $this->hasMany(CheckVoucherData::class, 'check_voucher_id', 'id')->orderBy('check_voucher_arrangement');
    }

    public function getBankId()
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }

}
