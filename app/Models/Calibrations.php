<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calibrations extends Model
{
    use HasFactory;
    protected $fillable = ['callib_name'];
    public $timestamps = false;
}