<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionData extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_summary_id',
        'account_number',
        'account_title',
        'update_transaction',
        'transaction_arrangement',
        'debits',
        'credits',
    ];

    public function chartOfAccounts()
    {
        return $this->belongsTo(ChartOfAccounts::class, 'account_number');
    }

}
