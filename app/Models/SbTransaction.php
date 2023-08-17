<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SbTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_summary_id',
    ];

    public $timestamps = false;

    public function getTransactionSummary()
    {
        return $this->belongsTo(TransactionSummary::class, 'transaction_summary_id');
    }

}
