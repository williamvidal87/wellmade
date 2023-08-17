<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CounterReceipt extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $fillable = [
        'date',
        'entries',
        'total',
        'paid',
        'client_id',
        'transaction_status_id',
    ];

    public function getClient()
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    public function getTransactionStatus()
    {
        return $this->hasOne(TransactionStatus::class, 'id', 'transaction_status_id');
    }

    public function getCounterReceiptData()
    {
        return $this->hasMany(CounterReceiptData::class, 'cr_id', 'id');
    }

}
