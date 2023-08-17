<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineConditionAquired extends Model
{
    use HasFactory;
    protected $fillable = [
        'machine_condition_acquired_name'
    ];
}
