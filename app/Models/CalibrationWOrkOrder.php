<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalibrationWorkOrder extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'jo_no_id',
        'jo_type_id',
        'reference_no_id',
        'calib_work_group_id',
        'work_sub_type_id',
        'general_procedure_id',
        'scope',
        'machine_id',
        'remarks',
        'parts_required',
        'hours',
        'qty',
        'price',
        'amount_increase',
        'discount_id',
        'incentive_type_id',
        'incentive',
        'status_id'        

    ];
   

    public function getStatus()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
}
