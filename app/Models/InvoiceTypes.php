<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTypes extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = ['invoice_type'];
}
