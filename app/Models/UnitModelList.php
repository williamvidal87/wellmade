<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModelList extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = ['unit_id','engine'];

    public function getUnit()
    {
        return $this->belongsTo(UnitModel::class,'unit_id');
    }
}
