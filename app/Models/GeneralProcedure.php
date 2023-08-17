<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralProcedure extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =['groups_id','work_sub_type_id','general_procedure_name'];
    
    public function getGroups()
    {
        return $this->belongsTo(SubGroup::class,'groups_id')->withTrashed();
    }
    
    public function getSubType()
    {
        return $this->belongsTo(SubGroupRates::class,'work_sub_type_id')->withTrashed();
    }
}
