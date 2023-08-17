<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanConsumeStatus extends Model
{
    use HasFactory;

    public $fillables = [
        'name',
    ];

    public $timestamps = false;

   
}

