<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErWorkGroup extends Model
{
    use HasFactory;

    protected $fillable = ['er_work_group_name'];
    public $timestamps = false;

    public function Scopes(){
        return $this->hasOne(Scopes::class);
    }
}
