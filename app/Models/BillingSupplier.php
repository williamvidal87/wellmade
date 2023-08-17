<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingSupplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact_number',
        'journalize',
        'status_id',
    ];

    public function getStatus()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
