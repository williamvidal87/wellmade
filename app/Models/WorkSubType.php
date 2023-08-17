<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSubType extends Model
{
    use HasFactory;

    protected $fillable = ['job_type_id','work_sub_type_name'];
    
    public function getJobType()
    {
        return $this->belongsTo(JobTypes::class,'job_type_id');
    }
}
