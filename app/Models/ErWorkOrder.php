<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErWorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'jo_no_id',
        // 'job_type_id',
        'er_work_group_id',
        'scope_of_work_id',
        'specification_id',
        'general_procedure_id',
        'work_sub_type_id',
        'machine_id',
        'description',
        'remarks',
        'parts_required_id',
        'hours',
        'qty',
        'price',
        'amount_increase',
        'discount_id',
        'max_discount',
        'incentive_type_id',
        'incentive'
    ];
}
