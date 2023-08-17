<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalibOrderUsedTool extends Model
{
    use HasFactory;
    
    protected $fillable =['calib_work_order_id','item_name','quantity'];
}
