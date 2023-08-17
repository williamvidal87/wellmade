<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component_Parts extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['parts_name'];
}