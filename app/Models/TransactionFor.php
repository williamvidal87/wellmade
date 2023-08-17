<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionFor extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    public $timestamps = false;
}
