<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddWorker extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable = ['work_order_id','assigned_worker_id','percent_id',
        'parts_percent_id','allot_hours','extension','start','end','reason_start',
        'reason_end','reason_stop','status','page_no','pause','resume'
    ];
    protected $dates = ['start','end'];

    public function getWorker(){
        return $this->belongsTo(User::class, 'assigned_worker_id');
    }
    public function getPercent(){
        return $this->belongsTo(Percent::class, 'percent_id');
    }
    public function getPartsPercent(){
        return $this->belongsTo(Percent::class, 'parts_percent_id');
    }
    public function Status(){
        return $this->belongsTo(Status::class, 'status');
    }
    public function getWorkOrder(){
        return $this->belongsTo(WorkOrder::class, 'work_order_id');
    }    
    public function getWorkers() {
        return $this->hasOne(User::class,'id', "assigned_worker_id");
    }
   
}
