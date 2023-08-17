<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineDepreciation extends Model
{
    use HasFactory;
    Protected $fillable = [
        'machine_depreciation_number'
    ];
}
