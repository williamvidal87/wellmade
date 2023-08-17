<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachinePurchaseFrom extends Model
{
    use HasFactory;
    Protected $fillable = [
        'machine_purchase_from_name'
    ];
}
