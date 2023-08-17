<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBilling extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date',
        'reference_no',
        'jo_no',
        'customer_name',
        'address',
        'contact_no',
        'job_type',
        'description',
        'cash_charge',
        // 'term_of_payment',
        'total_bill',
        'payment_type',
    ];
}
