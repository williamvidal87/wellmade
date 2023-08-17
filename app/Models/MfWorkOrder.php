<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MfWorkOrder extends Model
{
    use HasFactory;
    
    protected $fillable = [
        // 'jo_no_id',
        // 'job_type_id',
        'mf_work_group_id',
        'work_sub_type_id',
        'general_procedure_id',
        'scope_description',
        'process_group_id',
        'process_subgroup_id',
        'machine_id',
        'process_cost',
        'remarks',
        'parts_required_id',
        'hours',
        'qty',
        'price',
        'amount_increase',
        'discount_id',
        'max_discount',
        'incentive_type_id',
        'incentive',
    ];
    // Mao ni idugang
    // public function getWorkLoadUsedTools()
    // {
    // 		return $this->hasMany(WorkLoadUsedTool::class);
    // }
    public function getWorkGroup()
    {
        // return $this->belongsTo(MfWorkGroup::class);
        return $this->belongsTo(MfWorkGroup::class);
    }

    public function getSubType()
    {
        return $this->hasOne(Subtype::class);
    }

    public function getGeneralProcedure()
    {
        return $this->hasOne(GeneralProcedure::class);
    }
}
