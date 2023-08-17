<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnlockAccessReason extends Model
{
    use HasFactory;

    protected $fillable = [
        'jo_no_id',
        'reasons',
        'user_id',
    ];

}
