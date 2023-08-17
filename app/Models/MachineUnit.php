<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'machine_unit_name'
    ];
}
