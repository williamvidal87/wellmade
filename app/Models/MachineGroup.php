<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineGroup extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'machine_group_category_id',
        'machine_group_number_id',
        'machine_group_name'
    ];

    public function getMachineGroupCategory()
    {
        return $this->belongsTo(MachineCategory::class, 'machine_group_category_id');
    }

    public function getMachineGroupIdNumber()
    {
        return $this->hasOne(MachineIdNumber::class, 'id','machine_group_number_id');
    }
}
