<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineBrandName extends Model
{
    use HasFactory;

    protected $table = "machine_brand_names";
    protected $fillable = ['brand_name','acro_name'];
}