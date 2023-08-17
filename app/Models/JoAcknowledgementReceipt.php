<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JoAcknowledgementReceipt extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'jo_no',
        'term',
        'discount',
        'er_total',
        'mf_total',
        'calib_total',
        'overall_total',
    ];

    public function getJo()
    {
        return $this->belongsTo(JobOrder::class, 'jo_no');
    }

}
