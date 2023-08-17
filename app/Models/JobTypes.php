<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTypes extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = "job_types";

    protected $fillable = ['abbriv_code', 'description'];

   
}
