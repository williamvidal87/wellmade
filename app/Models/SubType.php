<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubType extends Model
{
    use HasFactory;

    protected $fillable = ['sub_type_name'];
    public $timestamps = false;

    public function getWorkOrder()
    {
        return $this->belongsTo(MfWorkOrder::class);
    }
}
