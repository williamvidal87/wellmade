<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubGroupRates extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;
    
    protected $fillable = ['job_type_id','sub_group', 'group_id'];
    
    public function getGroup()
    {
        return $this->belongsTo(SubGroup::class,'group_id')->withTrashed();
    }
}
