<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessSubGroup extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;
    
    protected $fillable = ['process_sub_group_name','process_group_id'];
    
    public function getGroups()
    {
        return $this->belongsTo(ProcessGroup::class,'process_group_id')->withTrashed();
    }
}
