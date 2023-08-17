<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScopeDescription extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;
    
    protected $fillable = ['sub_type_id', 'scope_description_name','general_procedure_id'];
    
    public function getSubTypes()
    {
        return $this->belongsTo(SubGroupRates::class,'sub_type_id')->withTrashed();
    }
    public function getGeneralProcedure()
    {
        return $this->belongsTo(GeneralProcedure::class,'general_procedure_id')->withTrashed();
    }
}
