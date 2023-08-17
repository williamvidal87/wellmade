<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachinePlantAssigned extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_plant_assigned_name'
    ];
}

