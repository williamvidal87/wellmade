<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestTool extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'date',
        'request_type',
        'remarks',
        'jo_no_id',
        'request_by_id',
        'status_id',
        'work_area_id',
    ];

    public function getRequestBy()
    {
        return $this->hasOne(User::class, 'id', 'request_by_id');
    }

    public function getStatus()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function requestToolsData()
    {
        return $this->hasMany(RequestToolData::class);
    }

    public function getWorkArea() {
        return $this->belongsTo(WorkArea::class,'work_area_id');
    }
    
    public function getJobOrder()
    {
        return $this->belongsTo(JobOrder::class, 'jo_no_id');
    }
}
