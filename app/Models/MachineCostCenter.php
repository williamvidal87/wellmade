<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineCostCenter extends Model
{
    use HasFactory;
    Protected $fillable = [
        'machine_cost_center_name'
    ];
}
