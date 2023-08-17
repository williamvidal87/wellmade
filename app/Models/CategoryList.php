<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryList extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    protected $fillable = ['type_id','category'];
    public $timestamps = false;
    
    public function getTypes()
    {
        return $this->belongsTo(Type::class,'type_id');
    }
}
