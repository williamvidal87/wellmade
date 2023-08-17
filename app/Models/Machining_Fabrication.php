<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machining_Fabrication extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['mf_name'];
    public $timestamps = false;
}