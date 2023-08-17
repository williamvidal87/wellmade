<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scopes extends Model
{
    use HasFactory;
    
    protected $fillable = ['scope_name', 'er_work_group_id','unit_id','price_a','price_b','price_c','price_d','price_e','price_f','price_g','price_h','price_i','price_j'];
    protected $hidden = ["created_at","updated_at"];

    public function getERWorkGroup(){
        return $this->belongsTo(SubGroup::class,'er_work_group_id');
    }

    public function getUnit(){
        return $this->belongsTo(ErUnit::class,'unit_id');
    }
}
