<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MakeList extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;

    protected $fillable = ['make_name'];

    public function Cylinder(){
        return $this->hasOne(CylinderList::class);
    }

    public function Category(){
        return $this->hasOne(CategoryList::class);
    }
    public function getMake()
    {
        return $this->hasMany(EngineModel::class);
    }
}
