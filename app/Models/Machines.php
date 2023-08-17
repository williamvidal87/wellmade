<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machines extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $casts = [
        'item_image' => 'array',
    ];
    
    protected $fillable = [
    'job_type_id',
    'machine_name',
    'machine_description_id',
    'machine_group_id',
    'machine_sub_group_id',
    'serial',
    'machine_brand_id',
    'machine_model_id',
    'machine_plant_assigned_id',
    'machine_dept_location_id',
    'machine_cost_center_id',
    'machine_status_id',
    'item_image',
    'machine_purchase_from_id',
    'machine_purchase_type_id',
    'machine_year_made_id',
    'machine_country_made_id',
    'arrival_date',
    'machine_condition_aquired_id',
    'machine_depreciation_id',
    'capacity',
    'machine_unit_id',
    'total_motor',
    'landed_cost',
    'rehab_cost',
    ];
    public $timestamps = false;
    
    public function getJobTypes()
    {
        return $this->belongsTo(JobTypes::class,'job_type_id');
    }
    
    public function getDeptLocation()
    {
        return $this->belongsTo(MachineDeptLocation::class,'machine_dept_location_id');
    }
    
    public function getDescription()
    {
        return $this->belongsTo(MachineDescription::class,'machine_description_id');
    }
    
    public function getGroups()
    {
        return $this->belongsTo(MachineGroup::class,'machine_group_id')->with('getMachineGroupIdNumber');
    }
    
    public function getAssignSubGroup()
    {
        return $this->belongsTo(AssignMachineSubgroup::class,'machine_sub_group_id')->with('getMachineSubGroup','getMachineNumber');
    }
    public function getMachineDescriptionName()
    {
        return $this->belongsTo(MachineDescription::class,'machine_description_id')->with('getmachinedescriptionnumberid');
    }
    public function getmachineunit()
    {
        return $this->belongsTo(MachineUnit::class,'machine_unit_id');
    }
    public function getmachinebrand()
    {
        return $this->belongsTo(MachineBrandName::class,'machine_brand_id');
    }
}