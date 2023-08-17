<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_summary_id',
    ];

    public function getTransactionSummary()
    {
        return $this->belongsTo(TransactionSummary::class, 'transaction_summary_id');
    }

}
