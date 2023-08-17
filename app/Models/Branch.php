<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'branch_name','company_name','address',
        'contact_no','owner_name'
    ];
}
