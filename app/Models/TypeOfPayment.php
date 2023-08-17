<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfPayment extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ['payment_type'];

}
