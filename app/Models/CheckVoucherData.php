<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckVoucherData extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'check_voucher_id',
        'account_number',
        'update_check_voucher',
        'check_voucher_arrangement',
        'debits',
        'credits',
    ];

    public function getChartOfAccounts()
    {
        return $this->hasOne(ChartOfAccounts::class, 'id', 'account_number');
    }

}
