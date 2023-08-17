<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineCategory extends Model
{
    use HasFactory;
    
    protected $fillable = ['engine_category'];
    public $timestamps = false;
}
