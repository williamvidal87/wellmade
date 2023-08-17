<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignMachineSubgroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_sub_group_number_id',
        'machine_group_id',
        'machine_sub_group_id'
    ];

    public function getMachineNumber()
    {
        return $this->belongsTo(MachineIdNumber::class, 'machine_sub_group_number_id');
    }

    public function getMachineGroup()
    {
        return $this->belongsTo(MachineGroup::class, 'machine_group_id');
    }

    public function getMachineSubGroup()
    {
        return $this->belongsTo(MachineSubGroupName::class, 'machine_sub_group_id');
    }
}

