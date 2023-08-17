<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class ActivityLogTable extends Model
{
   
    use HasFactory;
    protected $fillable = [
        'log_name',
        'description',
        'subject_id',
        'subject_type',
        'causer_id',
        'causer_type',
        'properties'
    ];

    public function getLoggedAtAttribute($date)
    {        
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y/m/d - h:i:s A');
    }

    
   
}
