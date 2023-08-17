<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkStatus extends Model
{
    use HasFactory;
    
    protected $fillable = ['work_status_type'];
    
    public $timestamps = false;
}
