<?php

namespace App\Models;

use Illuminate\Contracts\Queue\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;

    protected $fillable = ['status'];

    public function jobOrder(){
        $this->hasOne(JobOrder::class, 'status');
    }

    // public function calibrationWorkOrder()
    // {
    //     return $this->belongsTo(CalibrationWorkOrder::class,'status_id');
    // }
}
