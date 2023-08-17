<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErUnit extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ['unit'];

    public function Scopes(){
        return $this->hasOne(Scopes::class);
    }
}
