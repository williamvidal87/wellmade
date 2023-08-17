<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubGroup extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table= 'groups';
    protected $fillable = ['job_type_id','group_name'];
    
    
    public function getJobType()
    {
        return $this->belongsTo(JobTypes::class,'job_type_id');
    }
}
