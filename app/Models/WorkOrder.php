<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class WorkOrder extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'job_type_id',
        'jo_no_id',
        'reference_no_id',
        'mf_work_group_id',
        'mf_work_sub_type_id',
        'er_work_group_id',
        'scopes_id',
        'er_work_sub_type_id',
        'calib_work_group_id',
        'calib_work_sub_type_id',
        'specification_id',
        'general_procedure',
        'general_procedure_id',
        'scope_description',
        'scope_description_id',
        'process_group_id',
        'process_subgroup_id',
        'machine_id',
        'description',
        'suggested_cost',
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
        'status',
        'cancel_reason_id',
        'user_cancel_id',
        'work_order_start_id',
        'work_order_end_id',
        'total'
    ];    
    public function getWorkLoadUsedTools()
    {
    		return $this->hasMany(WorkLoadUsedTools::class);
    }
    public function getJobType(){
        return $this->belongsTo(JobTypes::class, 'job_type_id');
    }
    
    public function getWorkGroup()
    {
        // return $this->belongsTo(MfWorkGroup::class);
        return $this->belongsTo(MfWorkGroup::class);
    }

    public function getMFWorkGroup(){
        return $this->belongsTo(SubGroup::class, 'mf_work_group_id');
    }

    public function getMFWorkSubType(){
        return $this->belongsTo(SubGroupRates::class, 'mf_work_sub_type_id');
    }

    public function getERScope(){
        return $this->belongsTo(Scopes::class, 'scopes_id');
    }
    public function getDiscount(){
        return $this->belongsTo(Discount::class, 'discount_id');
    }

    public function getERWorkGroup(){
        return $this->BelongsTo(SubGroup::class, 'er_work_group_id');
    }
    public function getERWorkSubType(){
        return $this->belongsTo(SubGroupRates::class, 'er_work_sub_type_id');
    }

    public function getSubType()
    {
        return $this->hasOne(Subtype::class);
    }

    public function getCalibWorkGroup(){
        return $this->belongsTo(ScopeDescription::class, 'scope_description_id');
    }
    public function getCalibWorkSubType(){
        return $this->belongsTo(SubGroupRates::class, 'calib_work_sub_type_id');
    }

    public function getGeneralProcedure()
    {
        return $this->belongsTo(GeneralProcedure::class, 'general_procedure_id');
    }
    public function getJobOrder()
    {
        return $this->belongsTo(JobOrder::class,'jo_no_id');
    }
    public function getReferenceNo(){
        return $this->belongsTo(JobOrder::class,'reference_no_id');
    }
    public function getStatus(){
        return $this->belongsTo(Status::class, 'status');
    }
    public function getMachine(){
        return $this->belongsTo(Machines::class, 'machine_id');
    }
    public function getProcessGroup(){
        return $this->belongsTo(SubGroupRates::class, 'process_group_id');
    }
    public function getProcessSubGroup(){
        return $this->belongsTo(SubGroupRates::class,'process_subgroup_id');
    }
    public function getPartsRequired(){
        return $this->belongsTo(Status::class, 'parts_required_id');
    }
    public function getOperatorStartDate(){
        return $this->belongsTo(AddWorker::class, 'work_order_start_id');
    }
    public function getOperatorEndDate(){
        return $this->belongsTo(AddWorker::class, 'work_order_end_id');
    }
    public function workers(){
        return $this->hasMany(AddWorker::class, 'work_order_id');
    }
    public function getScopeDescription()
    {
        return $this->belongsTo(ScopeDescription::class, 'scope_description_id');
    }
    public function getStatusWorkOrder()
    {
        return $this->belongsTo(Status::class, 'status');
    }
    
    public function getIncentiveType()
    {
        return $this->belongsTo(IncentiveType::class, 'incentive_type_id');
    }

    public function getCancelReason()
    {
        return $this->belongsTo(DeleteReason::class, 'cancel_reason_id');
    }

    public function getUserCancel()
    {
        return $this->belongsTo(User::class, 'user_cancel_id');
    }

    public function getWorker() {
        return $this->hasMany(AddWorker::class, 'work_order_id');
    }

    public function operator() {
        return $this->belongsTo(AddWorker::class, 'work_order_start_id');
    }
    public function getScope() {
        return $this->belongsTo(Scopes::class, 'scopes_id');
    }

}
