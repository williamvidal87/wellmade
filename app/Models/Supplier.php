<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'contact_person',
        'contact_no',
        'email',
        'status_id',
    ];


    public function getStatus()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
