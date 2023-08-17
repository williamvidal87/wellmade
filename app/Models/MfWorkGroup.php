<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MfWorkGroup extends Model
{
    use HasFactory;
    // protected $table = 'mf_work_groups';
    public $timestamps = false;

    protected $fillable = ['mf_work_group_name'];

    public function getWorkOrder(){
        return $this->hasOne(MfWorkOrder::class);
    }
}



