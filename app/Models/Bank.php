<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'abbrv_bank',
        'bank_name',
        'gl_account_id',
    ];

    public function chartOfAccounts()
    {
        return $this->belongsTo(ChartOfAccounts::class, 'gl_account_id');
    }

    public $timestamps = false;
}
