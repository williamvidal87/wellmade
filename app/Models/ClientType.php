<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    use HasFactory;

    protected $fillable = ['client_type', 'industry_id'];
    
    public $timestamps = false;

    public function getIndustry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }
}
