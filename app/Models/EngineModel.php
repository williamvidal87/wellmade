<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EngineModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;
    
    protected $fillable = ['model','year_made_id','make_id','category_id','cylinder_id','valve_id'];
    
    public function getYearMade()
    {
        return $this->belongsTo(YearMade::class,'year_made_id');
    }
    public function getMake()
    {
        return $this->belongsTo(MakeList::class,'make_id')->withTrashed();
    }
    public function getCategory()
    {
        return $this->belongsTo(CategoryList::class,'category_id')->withTrashed();
    }
    public function getCylinder()
    {
        return $this->belongsTo(CylinderList::class,'cylinder_id')->withTrashed();
    }
    public function getValve()
    {
        return $this->belongsTo(Valve::class,'valve_id');
    }
}
