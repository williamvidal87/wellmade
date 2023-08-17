<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine_Parts extends Model
{
    use HasFactory;
    protected $fillable = ['engine_part_name'];
    public $timestamps = false;
}